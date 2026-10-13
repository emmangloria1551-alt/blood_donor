<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display users and their donor blood types.
     */
    public function index(Request $request)
    {
        // Load donor profiles so their blood types appear in User Management.
        $query = User::with('donor');

        // Search users.
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('contact_number', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhereHas('donor', function ($donorQuery) use ($search) {
                        $donorQuery->where('phone', 'like', "%{$search}%")
                            ->orWhere('address', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by blood type from the donor profile.
        if ($request->filled('blood_type')) {
            $bloodType = $request->input('blood_type');

            $query->where(function ($q) use ($bloodType) {
                $q->where('blood_type', $bloodType)
                    ->orWhereHas('donor', function ($donorQuery) use ($bloodType) {
                        $donorQuery->where('blood_type', $bloodType);
                    });
            });
        }

        // Filter by account status.
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by availability only when the users table has this column.
        if (
            $request->filled('availability')
            && \Illuminate\Support\Facades\Schema::hasColumn('users', 'availability')
        ) {
            $query->where('availability', $request->input('availability'));
        }

        $users = $query->latest()->paginate(10)->withQueryString();

        // User statistics.
        $totalUsers = User::count();
        $activeUsers = User::where('status', 'active')->count();
        $blockedUsers = User::where('status', 'blocked')->count();
        $administrators = User::where('role', 'admin')->count();

        return view('admin.users.index', compact(
            'users',
            'totalUsers',
            'activeUsers',
            'blockedUsers',
            'administrators'
        ));
    }

    /**
     * Show the create user form.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a new user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'blood_type' => ['nullable', Rule::in([
                'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-',
            ])],
            'address' => ['nullable', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:50'],
            'role' => ['required', Rule::in(['user', 'admin', 'donor'])],
            'availability' => ['nullable', Rule::in(['online', 'offline', 'available', 'unavailable'])],
        ]);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);
        $user->address = $validated['address'] ?? null;
        $user->contact_number = $validated['contact_number'] ?? null;
        $user->role = $validated['role'];
        $user->status = 'active';

        // Save blood type directly only if this column exists.
        if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'blood_type')) {
            $user->blood_type = $validated['blood_type'] ?? null;
        }

        // Save availability only if the column exists.
        if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'availability')) {
            $user->availability = $validated['availability'] ?? 'offline';
        }

        $user->save();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User added successfully.');
    }

    /**
     * Show one user.
     */
    public function show(User $user)
    {
        $user->load('donor');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the edit user form.
     */
    public function edit(User $user)
    {
        $user->load('donor');

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update a user.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'blood_type' => ['nullable', Rule::in([
                'A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-',
            ])],
            'address' => ['nullable', 'string', 'max:255'],
            'contact_number' => ['nullable', 'string', 'max:50'],
            'role' => ['required', Rule::in(['user', 'admin', 'donor'])],
            'availability' => ['nullable', Rule::in(['online', 'offline', 'available', 'unavailable'])],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->address = $validated['address'] ?? null;
        $user->contact_number = $validated['contact_number'] ?? null;
        $user->role = $validated['role'];

        if (\Illuminate\Support\Facades\Schema::hasColumn('users', 'blood_type')) {
            $user->blood_type = $validated['blood_type'] ?? null;
        }

        if (
            \Illuminate\Support\Facades\Schema::hasColumn('users', 'availability')
            && isset($validated['availability'])
        ) {
            $user->availability = $validated['availability'];
        }

        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Update the donor profile's blood type when this user has a donor profile.
        if ($user->donor && array_key_exists('blood_type', $validated)) {
            $user->donor->blood_type = $validated['blood_type'];
            $user->donor->save();
        }

        return redirect()
            ->route('admin.users')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Delete a user.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }
}