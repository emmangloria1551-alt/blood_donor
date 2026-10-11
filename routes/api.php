<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Community Blood Donor API
|--------------------------------------------------------------------------
*/

/*
|--------------------------------------------------------------------------
| API Test
|--------------------------------------------------------------------------
*/

Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'Community Blood Donor API is working!',
    ]);
});


/*
|--------------------------------------------------------------------------
| Login
|--------------------------------------------------------------------------
*/

Route::post('/login', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid email or password.',
        ], 401);
    }

    if ($user->status !== 'active') {
        return response()->json([
            'success' => false,
            'message' => 'Your account is not active.',
        ], 403);
    }

    return response()->json([
        'success' => true,
        'message' => 'Login successful.',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'blood_type' => $user->blood_type,
            'role' => $user->role,
            'status' => $user->status,
        ],
    ]);
});


Route::post('/blood-requests', function (Request $request) {

    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id',
        'patient_name' => 'required|string|max:255',
        'blood_type' => 'required|string|max:5',
        'units_needed' => 'required|integer|min:1',
        'hospital' => 'required|string|max:255',
        'notes' => 'nullable|string',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors' => $validator->errors(),
        ], 422);
    }

    $bloodRequest = \App\Models\BloodRequest::create([
        'user_id' => $request->user_id,
        'patient_name' => $request->patient_name,
        'blood_type' => $request->blood_type,
        'units_needed' => $request->units_needed,
        'status' => 'pending',
        'hospital' => $request->hospital,
        'notes' => $request->notes,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Blood request submitted successfully.',
        'request' => $bloodRequest,
    ], 201);
});

Route::post('/register', function (Request $request) {

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'blood_type' => 'nullable|string|max:5',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Registration failed.',
            'errors' => $validator->errors(),
        ], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'blood_type' => $request->blood_type,
        'role' => 'user',
        'status' => 'active',
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Registration successful.',
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'blood_type' => $user->blood_type,
            'role' => $user->role,
            'status' => $user->status,
        ],
    ], 201);
});

 Route::post('/donations/respond', function (Request $request) {

    $validator = Validator::make($request->all(), [
        'user_id' => 'required|exists:users,id',
        'blood_request_id' => 'required|exists:blood_requests,id',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors' => $validator->errors(),
        ], 422);
    }

    // Find the user
    $user = User::find($request->user_id);

    if (!$user) {
        return response()->json([
            'success' => false,
            'message' => 'User not found.',
        ], 404);
    }

    // Find the blood request
    $bloodRequest = \App\Models\BloodRequest::find(
        $request->blood_request_id
    );

    if (!$bloodRequest) {
        return response()->json([
            'success' => false,
            'message' => 'Blood request not found.',
        ], 404);
    }

    // Find the donor record connected to this user
    $donor = \App\Models\Donor::where(
        'user_id',
        $user->id
    )->first();

    // If the user does not have a donor record yet,
    // create one automatically.
    if (!$donor) {

         $donor = \App\Models\Donor::create([
    'user_id' => $user->id,
    'blood_type' => $bloodRequest->blood_type,
    'date_of_birth' => null,
    'phone' => null,
    'address' => null,
    'is_active' => true,
]);
    }

    // Create the donation record
    $donation = \App\Models\Donation::create([
        'donor_id' => $donor->id,
        'blood_type' => $bloodRequest->blood_type,
        'units' => $bloodRequest->units_needed,
        'status' => 'pending',
        'donated_at' => null,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Donation response submitted successfully.',
        'donation' => [
            'id' => $donation->id,
            'donor_id' => $donation->donor_id,
            'user_id' => $user->id,
            'donor_name' => $user->name,
            'blood_type' => $donation->blood_type,
            'units' => $donation->units,
            'status' => $donation->status,
            'blood_request_id' => $bloodRequest->id,
            'patient_name' => $bloodRequest->patient_name,
        ],
    ], 201);
});

/*
|--------------------------------------------------------------------------
| Get Blood Requests
|--------------------------------------------------------------------------
*/

Route::get('/blood-requests', function () {

    $requests = \App\Models\BloodRequest::orderBy(
        'created_at',
        'desc'
    )->get();

    return response()->json([
        'success' => true,
        'message' => 'Blood requests retrieved successfully.',
        'requests' => $requests,
    ]);
});

/*
|--------------------------------------------------------------------------
| Get Donors
|--------------------------------------------------------------------------
*/

Route::get('/donors', function () {

    $donors = \App\Models\Donor::with('user')
        ->orderBy('id', 'desc')
        ->get()
        ->map(function ($donor) {

            return [
                'id' => $donor->id,
                'user_id' => $donor->user_id,
                'name' => $donor->user?->name ?? 'Unknown Donor',
                'blood_type' => $donor->blood_type,
                'location' => $donor->address ?? 'Location not provided',
                'phone' => $donor->phone,
                'availability' => $donor->availability ?? 'available',
            ];
        });

    return response()->json([
        'success' => true,
        'message' => 'Donors retrieved successfully.',
        'donors' => $donors,
    ]);
});