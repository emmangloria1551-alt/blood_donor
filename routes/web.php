<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BloodRequestController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DonationCenterController;



/*
|--------------------------------------------------------------------------
| ADMIN LOGIN
|--------------------------------------------------------------------------
*/

// Show admin login page
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])
    ->name('admin.login');

    Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Process admin login
Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.submit');

// Admin logout
Route::post('/logout', [AdminAuthController::class, 'logout'])
    ->name('admin.logout');


/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('admin')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT
    |--------------------------------------------------------------------------
    */

Route::get('/users', [UserController::class, 'index'])
    ->name('admin.users');

Route::get('/users/create', [UserController::class, 'create'])
    ->name('admin.users.create');

Route::post('/users', [UserController::class, 'store'])
    ->name('admin.users.store');

Route::get('/users/{user}', [UserController::class, 'show'])
    ->name('admin.users.show');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])
    ->name('admin.users.edit');

Route::put('/users/{user}', [UserController::class, 'update'])
    ->name('admin.users.update');

Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->name('admin.users.destroy');

    /*
    |--------------------------------------------------------------------------
    | DONOR MANAGEMENT
    |--------------------------------------------------------------------------
    */

    Route::get('/donors', [DonorController::class, 'index'])
        ->name('admin.donors');


    /*
    |--------------------------------------------------------------------------
    | BLOOD REQUESTS
    |--------------------------------------------------------------------------
    */

    Route::get('/requests', [BloodRequestController::class, 'index'])
    ->name('admin.requests');


    /*
    |--------------------------------------------------------------------------
    | APPOINTMENTS
    |--------------------------------------------------------------------------
    */

      Route::get('/appointments', [AppointmentController::class, 'index'])
    ->name('admin.appointments');

Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])
    ->name('admin.appointments.show');

Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])
    ->name('admin.appointments.destroy');

    Route::patch(
    '/appointments/{appointment}/status',
    [AppointmentController::class, 'updateStatus']
)->name('admin.appointments.status');


    /*
    |--------------------------------------------------------------------------
    | DONATION CENTERS
    |--------------------------------------------------------------------------
    */

      Route::get('/centers', [DonationCenterController::class, 'index'])
    ->name('admin.centers');

Route::get('/centers/create', [DonationCenterController::class, 'create'])
    ->name('admin.centers.create');

Route::post('/centers', [DonationCenterController::class, 'store'])
    ->name('admin.centers.store');

Route::get('/centers/{center}', [DonationCenterController::class, 'show'])
    ->name('admin.centers.show');

Route::get('/centers/{center}/edit', [DonationCenterController::class, 'edit'])
    ->name('admin.centers.edit');

Route::put('/centers/{center}', [DonationCenterController::class, 'update'])
    ->name('admin.centers.update');

Route::delete('/centers/{center}', [DonationCenterController::class, 'destroy'])
    ->name('admin.centers.destroy');

    /*
    |--------------------------------------------------------------------------
    | NOTIFICATIONS
    |--------------------------------------------------------------------------
    */

    Route::get('/notifications', function () {
        return view('admin.notifications.index');
    })->name('admin.notifications');


    /*
    |--------------------------------------------------------------------------
    | REPORTS
    |--------------------------------------------------------------------------
    */

    Route::get('/reports', function () {
        return view('admin.reports.index');
    })->name('admin.reports');


    /*
    |--------------------------------------------------------------------------
    | SETTINGS
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', function () {
        return view('admin.settings.index');
    })->name('admin.settings');

});