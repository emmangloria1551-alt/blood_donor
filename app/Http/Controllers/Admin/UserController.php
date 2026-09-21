<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER LIST
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = User::query();

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');

            });
        }

        // Blood type filter
        if ($request->filled('blood_type')) {
            $query->where('blood_type', $request->blood_type);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // Statistics
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


    /*
    |--------------------------------------------------------------------------
    | SHOW ADD USER PAGE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.users.create');
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE NEW USER
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'min:8',
                'confirmed',
            ],

            'blood_type' => [
                'nullable',
                'in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            ],

            'role' => [
                'required',
                'in:user,admin',
            ],

            'status' => [
                'required',
                'in:active,blocked',
            ],
        ]);

        User::create([
            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => Hash::make($validated['password']),

            'blood_type' => $validated['blood_type'] ?? null,

            'role' => $validated['role'],

            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.users')
            ->with('success', 'User added successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | VIEW USER
    |--------------------------------------------------------------------------
    */

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW EDIT USER PAGE
    |--------------------------------------------------------------------------
    */

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE USER
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'password' => [
                'nullable',
                'min:8',
                'confirmed',
            ],

            'blood_type' => [
                'nullable',
                'in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            ],

            'role' => [
                'required',
                'in:user,admin',
            ],

            'status' => [
                'required',
                'in:active,blocked',
            ],
        ]);

        $user->name = $validated['name'];

        $user->email = $validated['email'];

        $user->blood_type = $validated['blood_type'] ?? null;

        $user->role = $validated['role'];

        $user->status = $validated['status'];

        // Only change password if one was entered
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User updated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE USER
    |--------------------------------------------------------------------------
    */

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User deleted successfully.');
    }
}