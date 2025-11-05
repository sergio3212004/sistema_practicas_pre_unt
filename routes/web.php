<?php

use App\Http\Controllers\Auth\EmpresaRegisterController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FichaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Invitados (login/registro)
Route::middleware('guest')->group(function () {
    Route::get('/empresa/registro',  [EmpresaRegisterController::class, 'create'])
        ->name('empresa.register');

    Route::post('/empresa/registro', [EmpresaRegisterController::class, 'store'])
        ->name('empresa.register.store');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('profesor')->name('profesor.')->group(function () {
    Route::get('/alumnos', [ProfesorController::class, 'alumnos'])->name('alumnos');
});

// Grupo de rutas para el rol alumno
Route::middleware(['auth'])->prefix('alumno')->name('alumno.')->group(function () {

    // Ficha de registro
    Route::get('/ficha-registro', [FichaController::class, 'index'])->name('ficha.index');
    Route::get('/ficha-registro/descargar', [FichaController::class, 'descargar'])->name('ficha.descargar');
    Route::post('/ficha-registro/subir', [FichaController::class, 'subir'])->name('ficha.subir');

    // Cronograma
    Route::post('/cronograma/subir', [CronogramaController::class, 'subir'])->name('cronograma.subir');
});

require __DIR__.'/auth.php';
