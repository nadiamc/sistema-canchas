<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\CanchaController;
use App\Http\Controllers\ReservaController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Todo lo que esté acá adentro va a pedir que el usuario esté logueado
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tus nuevas rutas para el CRUD del sistema de canchas
    Route::resource('canchas', CanchaController::class);
    Route::resource('reservas', ReservaController::class);
});

require __DIR__.'/auth.php';
