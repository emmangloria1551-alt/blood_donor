<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::with('donor')
            ->latest()
            ->paginate(10);

        return view(
            'admin.donation-records.index',
            compact('donations')
        );
    }

    public function create()
    {
        $donors = Donor::orderBy('id')->get();

        return view('admin.donation-records.create', compact('donors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_id' => [
                'required',
                'integer',
                'exists:donors,id',
            ],

            'blood_type' => [
                'required',
                Rule::in([
                    'A+', 'A-', 'B+', 'B-',
                    'AB+', 'AB-', 'O+', 'O-',
                ]),
            ],

            'units' => [
                'required',
                'integer',
                'min:1',
                'max:20',
            ],

            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'completed',
                    'rejected',
                ]),
            ],

            'donated_at' => [
                'nullable',
                'date',
                'before_or_equal:now',
            ],
        ]);

        Donation::create($validated);

        return redirect()
            ->route('admin.donation-records')
            ->with('success', 'Donation record added successfully!');
    }
}