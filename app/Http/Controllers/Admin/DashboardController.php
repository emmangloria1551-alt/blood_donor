<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Donor;
use App\Models\BloodRequest;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalUsers = User::count();

        $totalDonors = Donor::count();

        $totalBloodRequests = BloodRequest::count();


        /*
        |--------------------------------------------------------------------------
        | TOTAL DONATIONS
        |--------------------------------------------------------------------------
        |
        | The donations table already exists in your project.
        |
        */

        $totalDonations = 0;

        if (DB::getSchemaBuilder()->hasTable('donations')) {
            $totalDonations = DB::table('donations')->count();
        }


        /*
        |--------------------------------------------------------------------------
        | DONATION STATISTICS - LAST 6 MONTHS
        |--------------------------------------------------------------------------
        */

        $chartLabels = [];

        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {

            $date = Carbon::now()
                ->subMonths($i);

            $chartLabels[] = $date->format('M');

            $startOfMonth = $date
                ->copy()
                ->startOfMonth();

            $endOfMonth = $date
                ->copy()
                ->endOfMonth();

            $count = 0;

            if (DB::getSchemaBuilder()->hasTable('donations')) {

                $count = DB::table('donations')
                    ->whereBetween(
                        'created_at',
                        [
                            $startOfMonth,
                            $endOfMonth
                        ]
                    )
                    ->count();
            }

            $chartData[] = $count;
        }


        /*
        |--------------------------------------------------------------------------
        | RECENT ACTIVITIES
        |--------------------------------------------------------------------------
        */

        $recentActivities = collect();


        /*
        |--------------------------------------------------------------------------
        | RECENT USERS
        |--------------------------------------------------------------------------
        */

        $recentUsers = User::latest()
            ->take(5)
            ->get();

        foreach ($recentUsers as $user) {

            $recentActivities->push([
                'type' => 'user',
                'title' => 'New user registered',
                'description' => $user->name . ' created a new account.',
                'date' => $user->created_at,
                'icon' => 'bi-person-plus-fill',
                'class' => 'activity-user',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | RECENT BLOOD REQUESTS
        |--------------------------------------------------------------------------
        */

        $recentRequests = BloodRequest::latest()
            ->take(5)
            ->get();

        foreach ($recentRequests as $request) {

            $recentActivities->push([
                'type' => 'request',
                'title' => 'Blood request submitted',
                'description' =>
                    'A new ' .
                    ($request->blood_type ?? 'blood') .
                    ' blood request was submitted.',
                'date' => $request->created_at,
                'icon' => 'bi-droplet-fill',
                'class' => 'activity-request',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | RECENT APPOINTMENTS
        |--------------------------------------------------------------------------
        */

        $recentAppointments = Appointment::latest()
            ->take(5)
            ->get();

        foreach ($recentAppointments as $appointment) {

            $recentActivities->push([
                'type' => 'appointment',
                'title' => 'Appointment created',
                'description' =>
                    'A donation appointment was scheduled at ' .
                    $appointment->center . '.',
                'date' => $appointment->created_at,
                'icon' => 'bi-calendar-check-fill',
                'class' => 'activity-appointment',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | RECENT DONATIONS
        |--------------------------------------------------------------------------
        */

        if (DB::getSchemaBuilder()->hasTable('donations')) {

            $recentDonations = DB::table('donations')
                ->latest('created_at')
                ->take(5)
                ->get();

            foreach ($recentDonations as $donation) {

                $recentActivities->push([
                    'type' => 'donation',
                    'title' => 'Donation recorded',
                    'description' =>
                        'A blood donation was successfully recorded.',
                    'date' => $donation->created_at,
                    'icon' => 'bi-heart-pulse-fill',
                    'class' => 'activity-donation',
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SORT ACTIVITIES
        |--------------------------------------------------------------------------
        */

        $recentActivities = $recentActivities
            ->sortByDesc(function ($activity) {
                return $activity['date'];
            })
            ->take(4)
            ->values();


        /*
        |--------------------------------------------------------------------------
        | RETURN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.dashboard',
            compact(
                'totalUsers',
                'totalDonors',
                'totalBloodRequests',
                'totalDonations',
                'chartLabels',
                'chartData',
                'recentActivities'
            )
        );
    }
}