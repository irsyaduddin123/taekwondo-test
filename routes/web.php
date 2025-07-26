<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\TestComponentController;
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

// Routes untuk admin dan user
Route::middleware(['auth', 'role:admin,user'])->group(function () {
    Route::get('/athletes', [AthleteController::class, 'index'])->name('athletes.index');
    Route::get('/athletes/create', [AthleteController::class, 'create'])->name('athletes.create');
    Route::post('/athletes', [AthleteController::class, 'store'])->name('athletes.store');

    // Route::get('/athletes/{id}/edit', [AthleteController::class, 'edit'])->name('athletes.edit');

    Route::put('/athletes/{athlete}', [AthleteController::class, 'update'])->name('athletes.update');
    Route::delete('/athletes/{athlete}', [AthleteController::class, 'destroy'])->name('athletes.destroy');



    // Test Component Routes (Non-resource)
    Route::get('/admin/test-components', [TestComponentController::class, 'index'])->name('test_components.index');
    Route::get('/admin/test-components/create', [TestComponentController::class, 'create'])->name('test_components.create');
    Route::post('/admin/test-components', [TestComponentController::class, 'store'])->name('test_components.store');
    Route::get('/admin/test-components/{id}/edit', [TestComponentController::class, 'edit'])->name('test_components.edit');
    Route::put('/admin/test-components/{id}', [TestComponentController::class, 'update'])->name('test_components.update');
    Route::delete('/admin/test-components/{id}', [TestComponentController::class, 'destroy'])->name('test_components.destroy');

});


require __DIR__.'/auth.php';


