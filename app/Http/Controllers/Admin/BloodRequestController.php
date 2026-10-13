<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BloodRequest;
use Illuminate\Http\Request;

class BloodRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = BloodRequest::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('patient_name', 'like', "%{$search}%")
                  ->orWhere('blood_type', 'like', "%{$search}%")
                  ->orWhere('hospital', 'like', "%{$search}%");
            });
        }

        if ($request->filled('blood_type')) {
            $query->where('blood_type', $request->blood_type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $requests = $query->latest()->paginate(10)->withQueryString();

        $totalRequests = BloodRequest::count();

        $pendingRequests = BloodRequest::where(
            'status',
            'pending'
        )->count();

        $approvedRequests = BloodRequest::where(
            'status',
            'approved'
        )->count();

        $totalUnits = BloodRequest::sum('units_needed');

        return view('admin.requests.index', compact(
            'requests',
            'totalRequests',
            'pendingRequests',
            'approvedRequests',
            'totalUnits'
        ));
    }

    public function show(BloodRequest $bloodRequest)
    {
        return response()->json([
            'id' => $bloodRequest->id,
            'patient_name' => $bloodRequest->patient_name,
            'blood_type' => $bloodRequest->blood_type,
            'units_needed' => $bloodRequest->units_needed,
            'status' => $bloodRequest->status,
            'hospital' => $bloodRequest->hospital,
            'notes' => $bloodRequest->notes,
            'created_at' => $bloodRequest->created_at,
            'email' => $bloodRequest->user?->email,
        ]);
    }

    public function approve(BloodRequest $bloodRequest)
    {
        if ($bloodRequest->status !== 'pending') {
            return back()->with(
                'error',
                'Only pending requests can be approved.'
            );
        }

        $bloodRequest->update([
            'status' => 'approved',
        ]);

        return back()->with(
            'success',
            'Blood request approved successfully.'
        );
    }

    public function reject(
        Request $request,
        BloodRequest $bloodRequest
    ) {
        if (!in_array(
            $bloodRequest->status,
            ['pending', 'approved'],
            true
        )) {
            return back()->with(
                'error',
                'This request cannot be cancelled.'
            );
        }

        $validated = $request->validate([
            'reason' => ['nullable', 'string', 'max:1000'],
        ]);

        $notes = $bloodRequest->notes;

        if (!empty($validated['reason'])) {
            $notes = trim(
                ($notes ? $notes . "\n" : '') .
                'Cancellation reason: ' . $validated['reason']
            );
        }

        $bloodRequest->update([
            'status' => 'cancelled',
            'notes' => $notes,
        ]);

        return back()->with(
            'success',
            'Blood request cancelled successfully.'
        );
    }

    public function fulfill(BloodRequest $bloodRequest)
    {
        if ($bloodRequest->status !== 'approved') {
            return back()->with(
                'error',
                'Only approved requests can be fulfilled.'
            );
        }

        $bloodRequest->update([
            'status' => 'fulfilled',
        ]);

        return back()->with(
            'success',
            'Blood request marked as fulfilled.'
        );
    }
}