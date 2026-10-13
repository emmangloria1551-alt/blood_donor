<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BloodRequestController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\DonationCenterController;
use App\Http\Controllers\Admin\ForgotPasswordController;
use App\Http\Controllers\Admin\ResetPasswordController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\Admin\DonationController;




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

// Donor Management Routes
// Keep these inside your existing admin prefix group.

Route::get('/donors', [DonorController::class, 'index'])
    ->name('admin.donors');

Route::get('/donors/create', [DonorController::class, 'create'])
    ->name('admin.donors.create');

Route::post('/donors', [DonorController::class, 'store'])
    ->name('admin.donors.store');

Route::get('/donors/{donor}', [DonorController::class, 'show'])
    ->name('admin.donors.show');

Route::get('/donors/{donor}/edit', [DonorController::class, 'edit'])
    ->name('admin.donors.edit');

Route::put('/donors/{donor}', [DonorController::class, 'update'])
    ->name('admin.donors.update');

Route::delete('/donors/{donor}', [DonorController::class, 'destroy'])
    ->name('admin.donors.destroy');


    /*
    |--------------------------------------------------------------------------
    | BLOOD REQUESTS
    |--------------------------------------------------------------------------
    */

    Route::get('/requests', [BloodRequestController::class, 'index'])
        ->name('admin.requests');

    Route::get('/requests/{bloodRequest}', [BloodRequestController::class, 'show'])
        ->name('admin.requests.show');

    Route::patch('/requests/{bloodRequest}/approve', [BloodRequestController::class, 'approve'])
        ->name('admin.requests.approve');

    Route::patch('/requests/{bloodRequest}/reject', [BloodRequestController::class, 'reject'])
        ->name('admin.requests.reject');

    Route::patch('/requests/{bloodRequest}/fulfill', [BloodRequestController::class, 'fulfill'])
        ->name('admin.requests.fulfill');


 /*
    |--------------------------------------------------------------------------
    | Appointment Management
    |--------------------------------------------------------------------------
    */

    Route::get('/appointments', [AppointmentController::class, 'index'])
        ->name('appointments');

    // IMPORTANT: Create route must be before {appointment}
    Route::get('/appointments/create', [AppointmentController::class, 'create'])
        ->name('appointments.create');

    Route::post('/appointments', [AppointmentController::class, 'store'])
        ->name('appointments.store');

    Route::get('/appointments/{appointment}', [AppointmentController::class, 'show'])
        ->name('appointments.show');

    Route::patch('/appointments/{appointment}/status', [AppointmentController::class, 'updateStatus'])
        ->name('appointments.status');

    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])
        ->name('appointments.destroy');

        
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


// =====================================================
// ADMIN FORGOT PASSWORD
// =====================================================

Route::get('/forgot-password', [
    ForgotPasswordController::class,
    'showForgotPasswordForm'
])->name('admin.password.request');

Route::post('/forgot-password', [
    ForgotPasswordController::class,
    'sendResetLink'
])->name('admin.password.email');


// =====================================================
// PASSWORD RESET
// =====================================================

Route::get('/reset-password/{token}', [
    ForgotPasswordController::class,
    'showResetForm'
])->name('password.reset');

Route::post('/reset-password', [
    ForgotPasswordController::class,
    'resetPassword'
])->name('password.update');



 /*
|--------------------------------------------------------------------------
| Reports & Statistics
|--------------------------------------------------------------------------
*/

Route::get('/reports', [
    ReportsController::class,
    'index'
])->name('admin.reports');

Route::get('/reports/generate', [
    ReportsController::class,
    'generate'
])->name('admin.reports.generate');

Route::get('/reports/export-excel', [
    ReportsController::class,
    'exportExcel'
])->name('admin.reports.excel');

Route::get('/reports/export-pdf', [
    ReportsController::class,
    'exportPdf'
])->name('admin.reports.pdf');


/*
|--------------------------------------------------------------------------
| DONATION RECORDS
|--------------------------------------------------------------------------
*/

 
});