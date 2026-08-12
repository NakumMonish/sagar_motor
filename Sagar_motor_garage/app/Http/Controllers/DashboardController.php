<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $totalBills = Bill::count();
        $pendingPayments = Bill::where('payment_status', 'pending')->sum('grand_total');
        $todayBills = Bill::whereDate('bill_date', today())->count();
        $totalRevenue = Bill::where('payment_status', 'paid')->sum('grand_total');
        $totalCustomers = Customer::count();
        $recentBills = Bill::with(['customer', 'vehicle'])
            ->latest('bill_date')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalBills',
            'pendingPayments',
            'todayBills',
            'totalRevenue',
            'totalCustomers',
            'recentBills'
        ));
    }
}
