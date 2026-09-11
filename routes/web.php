<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\AdminAuthController;
 

// ===============================
// ADMIN DASHBOARD
// ===============================

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');


// ===============================
// USER MANAGEMENT
// ===============================

Route::get('/admin/users', function () {
    return view('admin.users.index');
})->name('admin.users');

Route::get('/admin/users/create', [UserController::class, 'create'])
    ->name('admin.users.create');

Route::post('/admin/users', [UserController::class, 'store'])
    ->name('admin.users.store');


// ===============================
// DONOR MANAGEMENT
// ===============================

Route::get('/admin/donors', [DonorController::class, 'index'])
    ->name('admin.donors');


// ===============================
// BLOOD REQUESTS
// ===============================

Route::get('/admin/requests', function () {
    return view('admin.requests.index');
})->name('admin.requests');


// ===============================
// APPOINTMENTS
// ===============================

Route::get('/admin/appointments', function () {
    return view('admin.appointments.index');
})->name('admin.appointments');


// ===============================
// DONATION CENTERS
// ===============================

Route::get('/admin/centers', function () {
    return view('admin.centers.index');
})->name('admin.centers');


// ===============================
// NOTIFICATIONS
// ===============================

Route::get('/admin/notifications', function () {
    return view('admin.notifications.index');
})->name('admin.notifications');


// ===============================
// REPORTS
// ===============================

Route::get('/admin/reports', function () {
    return view('admin.reports.index');
})->name('admin.reports');


// ===============================
// SETTINGS
// ===============================

Route::get('/admin/settings', function () {
    return view('admin.settings.index');
})->name('admin.settings');


  
 /*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

Route::post('/admin/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');

    /*
|--------------------------------------------------------------------------
| ADMIN DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

// ===============================
// ADMIN PANEL
// ===============================

Route::middleware('auth')->prefix('admin')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

});