<?php

namespace App\Http\Controllers;

use App\Models\Identity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class IdentityController extends Controller
{
    /**
     * get all identities
     */
    public function index(): JsonResponse
    {
        try {
            $identities = Identity::all();
            return response()->json($identities);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch identities',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get specific identity
     */
    public function show($id): JsonResponse
    {
        try {
            $identity = Identity::find($id);

            if (!$identity) {
                return response()->json([
                    'error' => 'Identity not found',
                    'message' => 'No identity found with ID: ' . $id
                ], 404);
            }

            return response()->json($identity);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch identity',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * create new identity
     */
    public function store(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $request->merge([
                'damage_types' => $request->damage_types ?? [],
                'specialties' => $request->specialties ?? [],
                'is_base' => $request->boolean('is_base') ?? false
            ]);

            $validated = $request->validate([
                'sinner' => 'required|string|max:255',
                'identity_name' => 'required|string|max:255',
                'rarity' => 'required|in:0,00,000',
                'damage_types' => 'required|array',
                'damage_types.*' => 'string|in:Slash,Pierce,Blunt',
                'specialties' => 'required|array',
                'specialties.*' => 'string',
                'image_url' => 'nullable|url|max:500',
                'season' => 'required|string|max:10',
                'is_base' => 'boolean'
            ]);

            $identity = Identity::create($validated);

            DB::commit();

            return response()->json([
                'message' => 'Identity created successfully',
                'data' => $identity
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Failed to create identity',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     *      update identity
     */
    public function update(Request $request, $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $identity = Identity::find($id);

            if (!$identity) {
                return response()->json([
                    'error' => 'Identity not found',
                    'message' => 'No identity found with ID: ' . $id
                ], 404);
            }

            $request->merge([
                'damage_types' => $request->has('damage_types') ? $request->damage_types : $identity->damage_types,
                'specialties' => $request->has('specialties') ? $request->specialties : $identity->specialties,
                'is_base' => $request->has('is_base') ? $request->boolean('is_base') : $identity->is_base
            ]);

            $validated = $request->validate([
                'sinner' => 'sometimes|string|max:255',
                'identity_name' => 'sometimes|string|max:255',
                'rarity' => 'sometimes|in:0,00,000',
                'damage_types' => 'sometimes|array',
                'damage_types.*' => 'string|in:Slash,Pierce,Blunt',
                'specialties' => 'sometimes|array',
                'specialties.*' => 'string',
                'image_url' => 'nullable|url|max:500',
                'season' => 'sometimes|string|max:10',
                'is_base' => 'sometimes|boolean'
            ]);

            $identity->update($validated);

            DB::commit();

            return response()->json([
                'message' => 'Identity updated successfully',
                'data' => $identity
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Failed to update identity',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * delete identity
     */
    public function destroy($id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $identity = Identity::find($id);

            if (!$identity) {
                return response()->json([
                    'error' => 'Identity not found',
                    'message' => 'No identity found with ID: ' . $id
                ], 404);
            }

            $identity->delete();

            DB::commit();

            return response()->json(null, 204);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Failed to delete identity',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show API testing page
     */
    public function manage()
    {
        try {
            $identities = Identity::all();
            return view('identities.manage', compact('identities'));
        } catch (\Exception $e) {
            // Fallback if database is not available
            $identities = collect();
            return view('identities.manage', compact('identities'));
        }
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
        try {
            $validated = $request->validate([
                'team_size' => 'required|integer|in:5,6,7,12',
                'include_base' => 'boolean',
                'damage_types' => 'sometimes|array',
                'damage_types.*' => 'string|in:Slash,Pierce,Blunt',
                'specialties' => 'sometimes|array',
                'specialties.*' => 'string',
                'rarities' => 'sometimes|array',
                'rarities.*' => 'in:0,00,000'
            ]);

            $query = Identity::query();

            if (!($request->get('include_base', false))) {
                $query->where('is_base', false);
            }

            if ($request->has('damage_types') && !empty($validated['damage_types'])) {
                $query->where(function ($q) use ($validated) {
                    foreach ($validated['damage_types'] as $damageType) {
                        $q->orWhereJsonContains('damage_types', $damageType);
                    }
                });
            }

            if ($request->has('specialties') && !empty($validated['specialties'])) {
                $query->where(function ($q) use ($validated) {
                    foreach ($validated['specialties'] as $specialty) {
                        $q->orWhereJsonContains('specialties', $specialty);
                    }
                });
            }

            if ($request->has('rarities') && !empty($validated['rarities'])) {
                $query->whereIn('rarity', $validated['rarities']);
            }

            $teamSize = $validated['team_size'];

            // Get available unique sinners that match the filters
            $availableSinners = $query->distinct()->pluck('sinner');

            if ($availableSinners->count() < $teamSize) {
                return response()->json([
                    'error' => 'Not enough unique sinners',
                    'message' => "Only {$availableSinners->count()} unique sinners match your criteria, but requested team size is $teamSize. Please adjust your filters."
                ], 400);
            }

            // Select random unique sinners
            $selectedSinners = $availableSinners->shuffle()->take($teamSize);
            $identities = collect();

            foreach ($selectedSinners as $sinner) {
                $identityQuery = Identity::query();

                if (!($request->get('include_base', false))) {
                    $identityQuery->where('is_base', false);
                }

                if ($request->has('damage_types') && !empty($validated['damage_types'])) {
                    $identityQuery->where(function ($q) use ($validated) {
                        foreach ($validated['damage_types'] as $damageType) {
                            $q->orWhereJsonContains('damage_types', $damageType);
                        }
                    });
                }

                if ($request->has('specialties') && !empty($validated['specialties'])) {
                    $identityQuery->where(function ($q) use ($validated) {
                        foreach ($validated['specialties'] as $specialty) {
                            $q->orWhereJsonContains('specialties', $specialty);
                        }
                    });
                }

                if ($request->has('rarities') && !empty($validated['rarities'])) {
                    $identityQuery->whereIn('rarity', $validated['rarities']);
                }

                // Add the sinner filter
                $identityQuery->where('sinner', $sinner);

                // Get random identity for this sinner
                $identity = $identityQuery->inRandomOrder()->first();

                if ($identity) {
                    $identities->push($identity);
                }
            }

            if ($identities->count() < $teamSize) {
                return response()->json([
                    'error' => 'Failed to generate complete team',
                    'message' => "Could only find {$identities->count()} identities out of requested $teamSize. Please adjust your filters."
                ], 400);
            }

            return response()->json([
                'message' => 'Team generated successfully',
                'team' => $identities,
                'team_size' => $teamSize,
                'unique_sinners_used' => $identities->pluck('sinner')->unique()->count(),
                'filters_applied' => [
                    'include_base' => $request->get('include_base', false),
                    'damage_types' => $request->get('damage_types', []),
                    'specialties' => $request->get('specialties', []),
                    'rarities' => $request->get('rarities', [])
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to generate team',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get available filters for team generation
     */
    public function getFilters(): JsonResponse
    {
        try {
            $damageTypes = Identity::select('damage_types')
                ->get()
                ->pluck('damage_types')
                ->flatten()
                ->unique()
                ->values();

            $specialties = Identity::select('specialties')
                ->get()
                ->pluck('specialties')
                ->flatten()
                ->unique()
                ->values();

            $rarities = Identity::select('rarity')
                ->distinct()
                ->get()
                ->pluck('rarity');

            $sinners = Identity::select('sinner')
                ->distinct()
                ->get()
                ->pluck('sinner');

            return response()->json([
                'damage_types' => $damageTypes,
                'specialties' => $specialties,
                'rarities' => $rarities,
                'sinners' => $sinners
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch filters',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
