<?php


use App\Http\Controllers\AnnualPlanController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HasilPrestasiController;
use App\Http\Controllers\MicrocycleController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestResultController;
use App\Http\Controllers\User\DashboardUserController;
use App\Http\Controllers\User\HasilTesUserController;
use App\Http\Controllers\User\PrestasiPribadiController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\ViewUserController;
use App\Http\Controllers\TestComponentController;
use App\Http\Controllers\AthleteController;

use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;

// ========================
// Halaman utama
// ========================
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ========================
// Login & Logout
// ========================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ========================
// Routes settings (auth wajib)
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
// Routes admin
// ========================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Athletes
    Route::get('/athletes', [AthleteController::class, 'index'])->name('athletes.index');
    Route::get('/athletes/create', [AthleteController::class, 'create'])->name('athletes.create');
    Route::post('/athletes', [AthleteController::class, 'store'])->name('athletes.store');
    Route::put('/athletes/{athlete}', [AthleteController::class, 'update'])->name('athletes.update');
    Route::delete('/athletes/{athlete}', [AthleteController::class, 'destroy'])->name('athletes.destroy');

    // Test Components & Types
    Route::prefix('admin/test-components')->group(function () {
        Route::get('/', [TestComponentController::class, 'index'])->name('test_components.index');
        Route::get('/create', [TestComponentController::class, 'createComponent'])->name('test_components.create');
        Route::post('/store', [TestComponentController::class, 'storeComponent'])->name('test_components.store');
        Route::get('/{id}/edit', [TestComponentController::class, 'editComponent'])->name('test_components.edit');
        Route::put('/{id}/update', [TestComponentController::class, 'updateComponent'])->name('test_components.update');
        Route::delete('/{id}/delete', [TestComponentController::class, 'destroyComponent'])->name('test_components.destroy');

        Route::post('/types/store', [TestComponentController::class, 'storeType'])->name('component_types.store');
        Route::put('/types/{id}/update', [TestComponentController::class, 'updateType'])->name('component_types.update');
        Route::delete('/types/{id}/delete', [TestComponentController::class, 'destroyType'])->name('component_types.destroy');
    });

    // Test Results
    Route::get('/admin/test-results', [TestResultController::class, 'index'])->name('test_results.index');
    Route::get('/admin/test-results/create', [TestResultController::class, 'create'])->name('test_results.create');
    Route::post('/admin/test-results', [TestResultController::class, 'store'])->name('test_results.store');
    Route::delete('/admin/test-results/{id}', [TestResultController::class, 'destroy'])->name('test_results.destroy');
    Route::get('/admin/test-results/export-pdf', [TestResultController::class, 'exportPdf'])->name('test_results.exportPdf');

    //Pengguna
    Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/pengguna', [PenggunaController::class, 'index'])->name('admin.pengguna');
        Route::put('/users/{id}/role', [PenggunaController::class, 'updateRole'])->name('admin.users.updateRole');
        Route::put('/athletes/{id}/user', [PenggunaController::class, 'updateUser'])->name('admin.athletes.updateUser');

        // Plans
        Route::post('/plans', [MicrocycleController::class, 'storePlan'])->name('plans.store');
        Route::delete('/plans/{id}', [MicrocycleController::class, 'destroyPlan'])->name('plans.destroy');
        Route::put('/plans/{id}', [MicrocycleController::class, 'updatePlan'])->name('plans.update');

        // Microcycles
        Route::get('/microcycles/create', [MicrocycleController::class, 'create'])->name('microcycles.create');
        Route::get('/microcycles', [MicrocycleController::class, 'index'])->name('microcycles.index');
        Route::delete('/microcycles/{id}', [MicrocycleController::class, 'destroyMicrocycle'])->name('microcycles.destroy');
        Route::post('/plans/{planId}/microcycles', [MicrocycleController::class, 'storeMicrocycle'])->name('microcycles.store');
        Route::put('/microcycles/{id}', [MicrocycleController::class, 'updateMicrocycle'])->name('microcycles.update');

        //Annual Plan
        Route::get('/annual-plan', [AnnualPlanController::class, 'index'])->name('annual-plan.index');

        //events
        Route::get('/events', [EventController::class, 'index'])->name('events.index');
        Route::post('/events', [EventController::class, 'store'])->name('events.store');
        Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
        Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');


        // routes/web.php
        Route::prefix('hasil-prestasi')->group(function () {
            Route::get('/', [HasilPrestasiController::class, 'index'])->name('hasil-prestasi.index');
            Route::get('/create', [HasilPrestasiController::class, 'create'])->name('hasil-prestasi.create');
            Route::post('/', [HasilPrestasiController::class, 'store'])->name('hasil-prestasi.store');
            Route::get('/{prestasi}/edit', [HasilPrestasiController::class, 'edit'])->name('hasil-prestasi.edit');
            Route::put('/{prestasi}', [HasilPrestasiController::class, 'update'])->name('hasil-prestasi.update');
            Route::delete('/{prestasi}', [HasilPrestasiController::class, 'destroy'])->name('hasil-prestasi.destroy');
        });


    });

});

// ========================
// Routes user
// ========================
Route::middleware(['auth', 'role:user'])->group(function () {
    // Route::get('/user', [ViewUserController::class,'index'])->name('user.index');
    Route::get('/user',[DashboardUserController::class,'index'])->name('dashboarduser');
    Route::get('/user/hasil-tes',[HasilTesUserController::class,'index'])->name('user.hasiltes');
    Route::post('/user/update-photo',[UserProfileController::class,'updatePhoto'])->name('user.updatePhoto');
     Route::get('/user/prestasi', [PrestasiPribadiController::class, 'index'])->name('user.prestasi.index');
    Route::put('/user/prestasi/{id}', [PrestasiPribadiController::class, 'update'])->name('user.prestasi.update');

});
