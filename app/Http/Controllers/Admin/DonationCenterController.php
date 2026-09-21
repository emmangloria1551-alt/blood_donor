<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonationCenter;
use Illuminate\Http\Request;

class DonationCenterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DISPLAY ALL DONATION CENTERS
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = DonationCenter::query();

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%')
                    ->orWhere('contact_number', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // STATUS FILTER
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // GET CENTERS
        $centers = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        // STATISTICS
        $totalCenters = DonationCenter::count();

        $openCenters = DonationCenter::where('status', 'open')->count();

        $closedCenters = DonationCenter::where('status', 'closed')->count();

        return view('admin.centers.index', compact(
            'centers',
            'totalCenters',
            'openCenters',
            'closedCenters'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW ADD CENTER FORM
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.centers.create');
    }


    /*
    |--------------------------------------------------------------------------
    | SAVE NEW CENTER
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'location' => 'required|string|max:255',

            'contact_number' => 'nullable|string|max:50',

            'opening_time' => 'nullable|date_format:H:i',

            'closing_time' => 'nullable|date_format:H:i',

            'status' => 'required|in:open,closed',

            'description' => 'nullable|string|max:1000',
        ]);

        DonationCenter::create($validated);

        return redirect()
            ->route('admin.centers')
            ->with('success', 'Donation center added successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | VIEW ONE CENTER
    |--------------------------------------------------------------------------
    */

    public function show(DonationCenter $center)
    {
        return view('admin.centers.show', compact('center'));
    }


    /*
    |--------------------------------------------------------------------------
    | SHOW EDIT FORM
    |--------------------------------------------------------------------------
    */

    public function edit(DonationCenter $center)
    {
        return view('admin.centers.edit', compact('center'));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE CENTER
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, DonationCenter $center)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'location' => 'required|string|max:255',

            'contact_number' => 'nullable|string|max:50',

            'opening_time' => 'nullable|date_format:H:i',

            'closing_time' => 'nullable|date_format:H:i',

            'status' => 'required|in:open,closed',

            'description' => 'nullable|string|max:1000',
        ]);

        $center->update($validated);

        return redirect()
            ->route('admin.centers')
            ->with('success', 'Donation center updated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE CENTER
    |--------------------------------------------------------------------------
    */

    public function destroy(DonationCenter $center)
    {
        $center->delete();

        return redirect()
            ->route('admin.centers')
            ->with('success', 'Donation center deleted successfully.');
    }
}