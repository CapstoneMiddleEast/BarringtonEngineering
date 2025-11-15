<?php

namespace App\Http\Controllers;

use App\Models\SalesEnquiry;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingEnquiriesCount = SalesEnquiry::where('quotation_status', 'Pending')->count();
        return view('dashboard', compact('pendingEnquiriesCount'));
    }
}
