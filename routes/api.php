<?php

use App\Http\Controllers\ReservaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Endpoint JSON que usás en programación III para JavaScript
Route::get('/reservas', [ReservaController::class, 'apiIndex']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum'); 