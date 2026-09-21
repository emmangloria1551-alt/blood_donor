<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodRequest;
use Illuminate\Http\Request;

class BloodRequestController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Get blood requests
        |--------------------------------------------------------------------------
        */

        $query = BloodRequest::with('user');


        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('patient_name', 'like', '%' . $search . '%')

                    ->orWhere('blood_type', 'like', '%' . $search . '%')

                    ->orWhere('hospital', 'like', '%' . $search . '%');

            });
        }


        /*
        |--------------------------------------------------------------------------
        | Blood Type Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('blood_type')) {

            $query->where(
                'blood_type',
                $request->blood_type
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Paginated Requests
        |--------------------------------------------------------------------------
        */

        $requests = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */

        $totalRequests = BloodRequest::count();

        $pendingRequests = BloodRequest::where(
            'status',
            'pending'
        )->count();

        $approvedRequests = BloodRequest::where(
            'status',
            'approved'
        )->count();

        $totalUnits = BloodRequest::sum(
            'units_needed'
        );


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.requests.index',
            compact(
                'requests',
                'totalRequests',
                'pendingRequests',
                'approvedRequests',
                'totalUnits'
            )
        );
    }
}