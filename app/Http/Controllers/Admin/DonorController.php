<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $query = Donor::with('user');

        // Search donor name, email, or blood type
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('blood_type', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    });
            });
        }

        // Blood type filter
        if ($request->filled('blood_type')) {
            $query->where('blood_type', $request->blood_type);
        }

        // Active/inactive filter
        if ($request->filled('status')) {
            $query->where(
                'is_active',
                $request->status === 'active'
            );
        }

        $donors = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistics
        $totalDonors = Donor::count();
        $activeDonors = Donor::where('is_active', true)->count();
        $inactiveDonors = Donor::where('is_active', false)->count();

        return view('admin.donors.index', compact(
            'donors',
            'totalDonors',
            'activeDonors',
            'inactiveDonors'
        ));
    }
}