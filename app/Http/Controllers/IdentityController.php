<?php

namespace App\Http\Controllers;

use App\Models\Identity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IdentityController extends Controller
{
    /**
     * Get all identities
     */
    public function index(): JsonResponse
    {
        $identities = Identity::all();
        return response()->json($identities);
    }

    /**
     * Get specific identity
     */
    public function show($id): JsonResponse
    {
        $identity = Identity::findOrFail($id);
        return response()->json($identity);
    }

    /**
     * Create new identity
     */
    public function store(Request $request): JsonResponse
    {
        $request->merge([
            'damage_types' => $request->damage_types ?? [],
            'specialties' => $request->specialties ?? []
        ]);

        $validated = $request->validate([
            'sinner' => 'required|string',
            'identity_name' => 'required|string',
            'rarity' => 'required|in:0,00,000',
            'damage_types' => 'required|array',
            'specialties' => 'required|array',
            'image_url' => 'nullable|string',
            'season' => 'required|string',
            'is_base' => 'boolean'
        ]);

        $identity = Identity::create($validated);
        return response()->json($identity, 201);
    }

    /**
     * Update identity
     */
    public function update(Request $request, $id): JsonResponse
    {
        $identity = Identity::findOrFail($id);

        $request->merge([
            'damage_types' => $request->damage_types ?? $identity->damage_types,
            'specialties' => $request->specialties ?? $identity->specialties
        ]);

        $validated = $request->validate([
            'sinner' => 'string',
            'identity_name' => 'string',
            'rarity' => 'in:0,00,000',
            'damage_types' => 'array',
            'specialties' => 'array',
            'image_url' => 'nullable|string',
            'season' => 'string',
            'is_base' => 'boolean'
        ]);

        $identity->update($validated);
        return response()->json($identity);
    }

    /**
     * Delete identity
     */
    public function destroy($id): JsonResponse
    {
        $identity = Identity::findOrFail($id);
        $identity->delete();
        return response()->json(null, 204);
    }

    /**
     * Show API testing page
     */
    public function manage()
    {
        $identities = Identity::all(); // This still works!
        return view('identities.manage', compact('identities'));
    }

    /**
     * Show team generator page
     */
    public function showGenerator()
    {
        return view('team-generator');
    }


    /**
     * Generate random team
     */
    public function generateTeam(Request $request): JsonResponse
    {
        $request->validate([
            'team_size' => 'required|in:5,6,7,12',
            'include_base' => 'boolean',
            'damage_types' => 'array',
            'damage_types.*' => 'in:Slash,Pierce,Blunt',
            'specialties' => 'array',
            'specialties.*' => 'string',
            'rarities' => 'array',
            'rarities.*' => 'in:0,00,000'
        ]);

        $query = Identity::query();

        if (!$request->get('include_base', false)) {
            $query->where('is_base', false);
        }

        if ($request->has('damage_types')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->damage_types as $damageType) {
                    $q->orWhereJsonContains('damage_types', $damageType);
                }
            });
        }

        if ($request->has('specialties')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->specialties as $specialty) {
                    $q->orWhereJsonContains('specialties', $specialty);
                }
            });
        }

        if ($request->has('rarities')) {
            $query->whereIn('rarity', $request->rarities);
        }

        $teamSize = $request->team_size;
        $identities = $query->inRandomOrder()->limit($teamSize)->get();

        return response()->json([
            'team' => $identities,
            'team_size' => $teamSize,
            'filters_applied' => [
                'include_base' => $request->get('include_base', false),
                'damage_types' => $request->get('damage_types', []),
                'specialties' => $request->get('specialties', []),
                'rarities' => $request->get('rarities', [])
            ]
        ]);
    }
}
