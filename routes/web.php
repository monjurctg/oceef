<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CelebrationRegistrationController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', function () {
    return view('Home');
});

// Celebration registration routes (public)
Route::get('/celebration', [CelebrationRegistrationController::class, 'showForm'])->name('celebration.registration.form');
Route::post('/celebration', [CelebrationRegistrationController::class, 'submitForm'])->name('celebration.registration.submit');

// Registration routes (public)
Route::get('/register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'submitForm'])->name('register.submit');

// Login routes
Route::get('login', [UserAuthController::class, 'showLoginForm'])->name('user.login.form');
Route::post('login', [UserAuthController::class, 'login'])->name('user.login');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

// Protected routes for admin and moderator
Route::middleware(['role:1,2'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Original registration admin routes
    Route::get('/registrations', [RegisterController::class, 'showRegistrations'])->name('registrations.index');
    Route::get('/registrations/{id}', [RegisterController::class, 'showRegistrationDetail'])->name('registration.show');
    Route::put('/register/{id}', [RegisterController::class, 'update'])->name('register.update');

    // Celebration registration admin routes

    Route::get('/celebration-registrations', [CelebrationRegistrationController::class, 'showRegistrations'])->name('celebration.registrations.index');
    Route::get('/celebration-registrations/{id}', [CelebrationRegistrationController::class, 'showRegistrationDetail'])->name('celebration.registration.show');
    Route::get('/celebration-registrations/{id}/print', [CelebrationRegistrationController::class, 'printRegistration'])->name('celebration.registration.print');
});

// Protected routes for admin only
Route::middleware(['role:1'])->group(function () {
    Route::get('/create-user', [DashboardController::class, 'showCreateForm']);
    Route::get('/users', [DashboardController::class, 'showUsers'])->name('users.index');
    Route::post('/storeFromRegistration', [DashboardController::class, 'createUserFromRegistration'])->name('storeFromRegistration.submit');

    // Original registration admin routes
    Route::post('/registration/{id}/approve', [RegisterController::class, 'approve'])->name('registration.approve');
    Route::get('/registration/{id}/edit', [RegisterController::class, 'edit'])->name('registration.edit');
    Route::delete('/registration/{id}/cancel', [RegisterController::class, 'cancel'])->name('registration.cancel');

    // Celebration registration admin routes (delete)
    Route::delete('/celebration-registrations/{id}', [CelebrationRegistrationController::class, 'destroy'])->name('celebration.registration.destroy');
});

// Dashboard - celebration registrations
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/celebrations', [\App\Http\Controllers\DashboardController::class, 'celebrations'])
        ->name('dashboard.celebrations');
});