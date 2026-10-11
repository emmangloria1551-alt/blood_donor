<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | USER MANAGEMENT - INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = User::query();

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('contact_number', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');

            });
        }


        /*
        |--------------------------------------------------------------------------
        | BLOOD TYPE FILTER
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
        | STATUS FILTER
        |--------------------------------------------------------------------------
        |
        | Status still exists in the database as active/blocked.
        | It is simply NOT shown on the Add User form.
        |
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );

        }


        /*
        |--------------------------------------------------------------------------
        | AVAILABILITY FILTER
        |--------------------------------------------------------------------------
        */

        if ($request->filled('availability')) {

            $query->where(
                'availability',
                $request->availability
            );

        }


        /*
        |--------------------------------------------------------------------------
        | GET USERS
        |--------------------------------------------------------------------------
        */

        $users = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalUsers = User::count();

        $activeUsers = User::where(
            'status',
            'active'
        )->count();

        $blockedUsers = User::where(
            'status',
            'blocked'
        )->count();

        $administrators = User::where(
            'role',
            'admin'
        )->count();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.users.index',
            compact(
                'users',
                'totalUsers',
                'activeUsers',
                'blockedUsers',
                'administrators'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE USER FORM
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'admin.users.create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE NEW USER
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        |
        | Notice:
        | There is NO status validation here.
        |
        | New users automatically become:
        |
        | status = active
        |
        */

        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' => 'required|email|max:255|unique:users,email',

            'password' => 'required|min:8|confirmed',

            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',

            'address' => 'nullable|string|max:255',

            'contact_number' => 'nullable|string|max:50',

            'role' => 'required|in:user,admin',

            'availability' => 'required|in:online,offline',

        ]);


        /*
        |--------------------------------------------------------------------------
        | CREATE USER
        |--------------------------------------------------------------------------
        */

        User::create([

            'name' => $validated['name'],

            'email' => $validated['email'],

            'password' => bcrypt(
                $validated['password']
            ),

            'blood_type' =>
                $validated['blood_type'] ?? null,

            'address' =>
                $validated['address'] ?? null,

            'contact_number' =>
                $validated['contact_number'] ?? null,

            'role' =>
                $validated['role'],

            /*
            |--------------------------------------------------------------------------
            | ACCOUNT STATUS
            |--------------------------------------------------------------------------
            |
            | Every newly created user is automatically active.
            |
            */

            'status' => 'active',

            /*
            |--------------------------------------------------------------------------
            | AVAILABILITY
            |--------------------------------------------------------------------------
            */

            'availability' =>
                $validated['availability'],

        ]);


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'User added successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW USER
    |--------------------------------------------------------------------------
    */

    public function show(User $user)
    {
        return view(
            'admin.users.show',
            compact('user')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT USER FORM
    |--------------------------------------------------------------------------
    */

    public function edit(User $user)
    {
        return view(
            'admin.users.edit',
            compact('user')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE USER
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        User $user
    ) {

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        |
        | Status is NOT required here.
        |
        | The existing status in the database will remain unchanged.
        |
        */

        $validated = $request->validate([

            'name' => 'required|string|max:255',

            'email' =>
                'required|email|unique:users,email,' . $user->id,

            'blood_type' =>
                'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',

            'address' =>
                'nullable|string|max:255',

            'contact_number' =>
                'nullable|string|max:50',

            'role' =>
                'required|in:user,admin',

            'availability' =>
                'required|in:online,offline',

            'password' =>
                'nullable|min:8|confirmed',

        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE BASIC INFORMATION
        |--------------------------------------------------------------------------
        */

        $user->name =
            $validated['name'];

        $user->email =
            $validated['email'];

        $user->blood_type =
            $validated['blood_type'] ?? null;

        $user->address =
            $validated['address'] ?? null;

        $user->contact_number =
            $validated['contact_number'] ?? null;

        $user->role =
            $validated['role'];

        $user->availability =
            $validated['availability'];


        /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD
        |--------------------------------------------------------------------------
        |
        | Only change the password if the administrator
        | entered a new password.
        |
        */

        if (
            !empty(
                $validated['password']
            )
        ) {

            $user->password =
                bcrypt(
                    $validated['password']
                );

        }


        /*
        |--------------------------------------------------------------------------
        | DO NOT CHANGE STATUS
        |--------------------------------------------------------------------------
        |
        | The existing active/blocked value stays as it is.
        |
        */


        /*
        |--------------------------------------------------------------------------
        | SAVE USER
        |--------------------------------------------------------------------------
        */

        $user->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('admin.users')
            ->with(
                'success',
                'User updated successfully.'
            );
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
            ->with(
                'success',
                'User deleted successfully.'
            );
    }
}