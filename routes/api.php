<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;

Route::prefix( 'v1' )->name( 'api.v1.' )->group( function () {
    // Public routes
    Route::post( '/login', [AuthController::class, 'login'] )->name( 'login' );
    Route::post( '/register', [AuthController::class, 'register'] )->name( 'register' );
    
    // Protected routes
    Route::middleware( 'auth:sanctum' )->group( function () {
        Route::post( '/logout', [AuthController::class, 'logout'] )->name( 'logout' );
    } );
} );

// Fallback route for undefined endpoints
Route::fallback( function () {
    return response()->json( [
        'message' => 'Endpoint not found',
    ], 404 );
} );
