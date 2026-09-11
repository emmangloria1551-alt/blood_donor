<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donor;
use Illuminate\Http\Request;

class DonorController extends Controller
{
    public function index()
    {
        $donors = Donor::with('user')
            ->latest()
            ->get();

        return view('admin.donors.index', compact('donors'));
    }
}