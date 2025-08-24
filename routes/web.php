<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestResultController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\TestComponentController;
use App\Http\Controllers\AthleteController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ========================
// Settings (auth wajib)
// ========================
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/update-photo', [ProfileController::class, 'updatePhoto'])->name('profile.update-photo');
});

// ========================
// Routes untuk admin & user
// ========================
Route::middleware(['auth', 'role:admin,user'])->group(function () {
    // Athletes
    Route::get('/athletes', [AthleteController::class, 'index'])->name('athletes.index');
    Route::get('/athletes/create', [AthleteController::class, 'create'])->name('athletes.create');
    Route::post('/athletes', [AthleteController::class, 'store'])->name('athletes.store');
    Route::put('/athletes/{athlete}', [AthleteController::class, 'update'])->name('athletes.update');
    Route::delete('/athletes/{athlete}', [AthleteController::class, 'destroy'])->name('athletes.destroy');

    // ========================
    // Grouping admin
    // ========================
    Route::prefix('admin')->group(function () {
        // --- Test Components & Types ---
        // --- Test Components ---
            Route::prefix('test-components')->group(function () {
                // Index
                Route::get('/', [TestComponentController::class, 'index'])->name('test_components.index');

                // Components (pindah halaman)
                Route::get('/create', [TestComponentController::class, 'createComponent'])->name('test_components.create');
                Route::post('/store', [TestComponentController::class, 'storeComponent'])->name('test_components.store');
                Route::get('/{id}/edit', [TestComponentController::class, 'editComponent'])->name('test_components.edit');
                Route::put('/{id}/update', [TestComponentController::class, 'updateComponent'])->name('test_components.update');
                Route::delete('/{id}/delete', [TestComponentController::class, 'destroyComponent'])->name('test_components.destroy');

                // Types (pakai modal)
                Route::post('/types/store', [TestComponentController::class, 'storeType'])->name('component_types.store');
                Route::put('/types/{id}/update', [TestComponentController::class, 'updateType'])->name('component_types.update');
                Route::delete('/types/{id}/delete', [TestComponentController::class, 'destroyType'])->name('component_types.destroy');
            });


        // --- Test Results ---
        Route::get('/test-results', [TestResultController::class, 'index'])->name('test_results.index');
        Route::get('/test-results/create', [TestResultController::class, 'create'])->name('test_results.create');
        Route::post('/test-results', [TestResultController::class, 'store'])->name('test_results.store');
        Route::delete('/test-results/{id}', [TestResultController::class, 'destroy'])->name('test_results.destroy');
        Route::get('/test-results/export-pdf', [TestResultController::class, 'exportPdf'])->name('test_results.exportPdf');
    });
});

require __DIR__.'/auth.php';
