<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donor;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalAdmins = User::where('role', 'admin')->count();

        $activeUsers = User::where('status', 'active')->count();

        $blockedUsers = User::where('status', 'blocked')->count();

        $totalDonors = Donor::count();

        $availableDonors = Donor::where('availability', 'available')->count();

        $unavailableDonors = Donor::where('availability', 'unavailable')->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAdmins',
            'activeUsers',
            'blockedUsers',
            'totalDonors',
            'availableDonors',
            'unavailableDonors'
        ));
    }
}