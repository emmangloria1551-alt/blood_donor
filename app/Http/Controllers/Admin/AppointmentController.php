<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Appointment::with(['user', 'donor']);

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('center', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery
                            ->where('name', 'like', '%' . $search . '%')
                            ->orWhere('email', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('donor', function ($donorQuery) use ($search) {
                        $donorQuery
                            ->where('blood_type', 'like', '%' . $search . '%');
                    });
            });
        }

        // STATUS FILTER
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // DATE FILTER
        if ($request->filled('date')) {
            $query->whereDate(
                'appointment_date',
                $request->date
            );
        }

        // APPOINTMENTS
        $appointments = $query
            ->orderBy('appointment_date', 'asc')
            ->orderBy('appointment_time', 'asc')
            ->paginate(10)
            ->withQueryString();

        // STATISTICS
        $totalAppointments = Appointment::count();

        $pendingAppointments = Appointment::where(
            'status',
            'pending'
        )->count();

        $confirmedAppointments = Appointment::where(
            'status',
            'confirmed'
        )->count();

        $completedAppointments = Appointment::where(
            'status',
            'completed'
        )->count();

        return view(
            'admin.appointments.index',
            compact(
                'appointments',
                'totalAppointments',
                'pendingAppointments',
                'confirmedAppointments',
                'completedAppointments'
            )
        );
    }


    // VIEW APPOINTMENT
    public function show(Appointment $appointment)
    {
        $appointment->load(['user', 'donor']);

        return view(
            'admin.appointments.show',
            compact('appointment')
        );
    }


    // CHANGE APPOINTMENT STATUS
    public function updateStatus(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Appointment status updated successfully.'
            );
    }


    // DELETE APPOINTMENT
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('admin.appointments')
            ->with(
                'success',
                'Appointment deleted successfully.'
            );
    }
}