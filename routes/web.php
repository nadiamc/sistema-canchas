<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CanchaController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//RUTAS PROTEGIDAS (requieren login)
Route::middleware('auth')->group(function () {

    //Perfil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //CRUD Canchas
    Route::resource('canchas', CanchaController::class);

    //CRUD Reservas
    Route::resource('reservas', ReservaController::class);
});

require __DIR__.'/auth.php';
