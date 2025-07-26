<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\AthleteController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Routes untuk settings (masih dengan auth)
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// ✅ Gabungkan middleware di sini langsung (auth + role)
Route::middleware(['auth', 'role:admin,user'])->group(function () {
    Route::get('/athletes', [AthleteController::class, 'index'])->name('athletes.index');
    Route::get('/athletes/create', [AthleteController::class, 'create'])->name('athletes.create');
    Route::post('/athletes', [AthleteController::class, 'store'])->name('athletes.store');
    Route::get('/athletes/{id}/edit', [AthleteController::class, 'edit'])->name('athletes.edit');
    Route::put('/athletes/{id}', [AthleteController::class, 'update'])->name('athletes.update');
    Route::delete('/athletes/{id}', [AthleteController::class, 'destroy'])->name('athletes.destroy');
});

require __DIR__.'/auth.php';


