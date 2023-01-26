<?php

//Importamos ChirpController
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//[1] Creamos la ruta que utilizara el controlador para manejar el backend
Route::resource('chirps', ChirpController::class)
    //Permite el uso unico de los siguientes metodos. 
    ->only(['index', 'store', /* [9 -> ChirpController] */ 'edit', 'update', /* [11 -> ChirpController] */ 'destroy'])
    //Agrega el metodo de verificacion de usuario  -> ChirpController
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
