<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Donor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AppointmentController extends Controller
{
    /**
     * Display all appointments.
     */
    public function index(Request $request)
    {
        $query = Appointment::with(['user', 'donor.user']);

        // Search appointments
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('center', 'like', "%{$search}%")
                    ->orWhere('notes', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('donor', function ($donorQuery) use ($search) {
                        $donorQuery->where('blood_type', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by appointment date
        if ($request->filled('date')) {
            $query->whereDate('appointment_date', $request->date);
        }

        $appointments = $query
            ->orderByDesc('appointment_date')
            ->orderBy('appointment_time')
            ->paginate(10)
            ->withQueryString();

        $totalAppointments = Appointment::count();

        $totalReservations = Appointment::whereIn(
            'status',
            ['pending', 'confirmed']
        )->count();

        $pendingAppointments = Appointment::where(
            'status',
            'pending'
        )->count();

        return view('admin.appointments.index', compact(
            'appointments',
            'totalAppointments',
            'totalReservations',
            'pendingAppointments'
        ));
    }

    /**
     * Display the create appointment form.
     */
    public function create()
    {
        $donors = Donor::with('user')->get();

        return view('admin.appointments.create', compact('donors'));
    }

    /**
     * Save a new appointment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'donor_id' => [
                'required',
                Rule::exists('donors', 'id'),
            ],
            'center' => [
                'required',
                'string',
                'max:255',
            ],
            'appointment_date' => [
                'required',
                'date',
            ],
            'appointment_time' => [
                'required',
                'date_format:H:i',
            ],
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'confirmed',
                    'completed',
                    'cancelled',
                ]),
            ],
            'notes' => [
                'nullable',
                'string',
                'max:2000',
            ],
        ]);

        $donor = Donor::findOrFail($validated['donor_id']);

        $validated['user_id'] = $donor->user_id;

        Appointment::create($validated);

        // IMPORTANT: Your route is named "appointments", not "admin.appointments".
        return redirect()
            ->route('appointments')
            ->with('success', 'Appointment created successfully.');
    }

    /**
     * Display one appointment.
     */
    public function show(Appointment $appointment)
    {
        $appointment->load(['user', 'donor.user']);

        return view('admin.appointments.show', compact('appointment'));
    }

    /**
     * Update an appointment's status.
     */
    public function updateStatus(
        Request $request,
        Appointment $appointment
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'confirmed',
                    'completed',
                    'cancelled',
                ]),
            ],
        ]);

        $appointment->update($validated);

        return redirect()
            ->route('appointments')
            ->with('success', 'Appointment status updated successfully.');
    }

    /**
     * Delete an appointment.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('appointments')
            ->with('success', 'Appointment deleted successfully.');
    }
}