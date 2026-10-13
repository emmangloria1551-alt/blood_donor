<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DonorController extends Controller
{
    /**
     * Display all donors.
     */
    public function index(Request $request)
    {
        $query = Donor::with('user');

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('phone', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('blood_type')) {
            $query->where('blood_type', $request->blood_type);
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $donors = $query->latest()->paginate(10)->withQueryString();

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

    /**
     * Show the create donor form.
     */
    public function create()
    {
        return view('admin.donors.create');
    }

    /**
     * Save a new donor and synchronize the blood type.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'blood_type' => [
                'required',
                Rule::in([
                    'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-',
                ]),
            ],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($validated, $request) {
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = Hash::make(Str::random(40));
            $user->role = 'donor';
            $user->status = 'active';

            // Save blood type to users if the column exists.
            if (DB::getSchemaBuilder()->hasColumn('users', 'blood_type')) {
                $user->blood_type = $validated['blood_type'];
            }

            $user->save();

            $donor = new Donor();
            $donor->user_id = $user->id;
            $donor->blood_type = $validated['blood_type'];
            $donor->phone = $validated['phone'];
            $donor->address = $validated['address'];
            $donor->is_active = $request->boolean('is_active');
            $donor->save();
        });

        return redirect()
            ->route('admin.donors')
            ->with('success', 'Donor registered successfully. Blood type saved and linked to User Management.');
    }

    /**
     * Display one donor.
     */
    public function show(Donor $donor)
    {
        $donor->load('user');

        return view('admin.donors.show', compact('donor'));
    }

    /**
     * Show the edit donor form.
     */
    public function edit(Donor $donor)
    {
        $donor->load('user');

        return view('admin.donors.edit', compact('donor'));
    }

    /**
     * Update a donor and synchronize the blood type.
     */
    public function update(Request $request, Donor $donor)
    {
        $donor->load('user');

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($donor->user_id),
            ],
            'blood_type' => [
                'required',
                Rule::in([
                    'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-',
                ]),
            ],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:1000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        DB::transaction(function () use ($validated, $request, $donor) {
            $user = $donor->user;

            if (!$user) {
                abort(404, 'The user account linked to this donor was not found.');
            }

            $user->name = $validated['name'];
            $user->email = $validated['email'];

            if (DB::getSchemaBuilder()->hasColumn('users', 'blood_type')) {
                $user->blood_type = $validated['blood_type'];
            }

            $user->save();

            $donor->blood_type = $validated['blood_type'];
            $donor->phone = $validated['phone'];
            $donor->address = $validated['address'];
            $donor->is_active = $request->boolean('is_active');
            $donor->save();
        });

        return redirect()
            ->route('admin.donors')
            ->with('success', 'Donor updated successfully. Blood type synchronized.');
    }

    /**
     * Delete a donor profile only.
     */
    public function destroy(Donor $donor)
    {
        $donor->delete();

        return redirect()
            ->route('admin.donors')
            ->with('success', 'Donor profile deleted successfully.');
    }
}