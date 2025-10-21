<?php

use App\Http\Controllers\IdentityController;
use Illuminate\Support\Facades\Route;

// Team generator page
Route::get('/', [IdentityController::class, 'showGenerator'])->name('home');

// API test page
Route::get('/identities', [IdentityController::class, 'manage'])->name('identities.manage');

// API endpoints
Route::prefix('api')->group(function () {
    Route::apiResource('identities', IdentityController::class);
    Route::post('/identities/generate-team', [IdentityController::class, 'generateTeam'])
        ->withoutMiddleware(['web']);
});
