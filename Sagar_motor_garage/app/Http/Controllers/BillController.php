<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillItem;
use App\Models\CarCompany;
use App\Models\Customer;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    /**
     * Display all bills with search & filter.
     */
    public function index(Request $request)
    {
        $query = Bill::with(['customer', 'vehicle'])->latest('bill_date');

        // Search by customer name or car number
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('customer', function ($cq) use ($search) {
                    $cq->where('name', 'like', "%{$search}%");
                })->orWhereHas('vehicle', function ($vq) use ($search) {
                    $vq->where('car_number', 'like', "%{$search}%");
                });
            });
        }

        // Filter by payment status
        if ($status = $request->input('status')) {
            if (in_array($status, ['paid', 'pending'])) {
                $query->where('payment_status', $status);
            }
        }

        $bills = $query->paginate(15)->withQueryString();

        return view('bills.index', compact('bills'));
    }

    /**
     * Show the bill generation form.
     */
    public function create()
    {
        $carCompanies = CarCompany::orderBy('name', 'asc')->get();
        return view('bills.create', compact('carCompanies'));
    }

    /**
     * Store a new bill with customer, vehicle, and line items.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'car_number' => 'required|string|max:50',
            'car_name' => 'required|string|max:255',
            'car_model' => 'nullable|string|max:255',
            'car_company' => 'required|string|max:255',
            'service_type' => 'required|in:denting,painting,general_service',
            'items' => 'required|array|min:1',
            'items.*.part_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'labor_cost' => 'nullable|numeric|min:0',
            'payment_status' => 'required|in:paid,pending',
        ]);

        $bill = DB::transaction(function () use ($request) {
            // Create or find customer
            $customer = Customer::firstOrCreate(
                ['mobile' => $request->mobile],
                ['name' => $request->customer_name]
            );

            // Update customer name if it changed
            if ($customer->name !== $request->customer_name) {
                $customer->update(['name' => $request->customer_name]);
            }

            // Create or find vehicle
            $vehicle = Vehicle::firstOrCreate(
                [
                    'customer_id' => $customer->id,
                    'car_number' => strtoupper($request->car_number),
                ],
                [
                    'car_name' => $request->car_name,
                    'car_model' => $request->car_model,
                    'car_company' => $request->car_company,
                ]
            );

            // Update vehicle details if they changed
            $vehicle->update([
                'car_name' => $request->car_name,
                'car_model' => $request->car_model,
                'car_company' => $request->car_company,
            ]);

            // Calculate subtotal from items
            $subtotal = 0;
            foreach ($request->items as $item) {
                $subtotal += $item['quantity'] * $item['price'];
            }

            $laborCost = $request->labor_cost ?? 0;
            $grandTotal = $subtotal + $laborCost;

            // Create the bill
            $bill = Bill::create([
                'customer_id' => $customer->id,
                'vehicle_id' => $vehicle->id,
                'service_type' => $request->service_type,
                'subtotal' => $subtotal,
                'labor_cost' => $laborCost,
                'grand_total' => $grandTotal,
                'payment_status' => $request->payment_status,
                'bill_date' => now()->toDateString(),
            ]);

            // Create bill items
            foreach ($request->items as $item) {
                BillItem::create([
                    'bill_id' => $bill->id,
                    'part_name' => $item['part_name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price'],
                ]);
            }

            return $bill;
        });

        return redirect()->route('bills.show', $bill->id)
            ->with('success', 'Bill generated successfully!');
    }

    /**
     * Display a printable bill/invoice.
     */
    public function show(Bill $bill)
    {
        $bill->load(['customer', 'vehicle', 'items']);

        return view('bills.show', compact('bill'));
    }

    /**
     * Show the bill edit form.
     */
    public function edit(Bill $bill)
    {
        $bill->load(['customer', 'vehicle', 'items']);
        $carCompanies = CarCompany::orderBy('name', 'asc')->get();

        return view('bills.edit', compact('bill', 'carCompanies'));
    }

    /**
     * Update an existing bill.
     */
    public function update(Request $request, Bill $bill)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'mobile' => 'required|string|max:15',
            'car_number' => 'required|string|max:50',
            'car_name' => 'required|string|max:255',
            'car_model' => 'nullable|string|max:255',
            'car_company' => 'required|string|max:255',
            'service_type' => 'required|in:denting,painting,general_service',
            'items' => 'required|array|min:1',
            'items.*.part_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'labor_cost' => 'nullable|numeric|min:0',
            'payment_status' => 'required|in:paid,pending',
        ]);

        DB::transaction(function () use ($request, $bill) {
            // Update customer
            $bill->customer->update([
                'name' => $request->customer_name,
                'mobile' => $request->mobile,
            ]);

            // Update vehicle
            $bill->vehicle->update([
                'car_number' => strtoupper($request->car_number),
                'car_name' => $request->car_name,
                'car_model' => $request->car_model,
                'car_company' => $request->car_company,
            ]);

            // Recalculate subtotal
            $subtotal = 0;
            foreach ($request->items as $item) {
                $subtotal += $item['quantity'] * $item['price'];
            }

            $laborCost = $request->labor_cost ?? 0;
            $grandTotal = $subtotal + $laborCost;

            // Update bill
            $bill->update([
                'service_type' => $request->service_type,
                'subtotal' => $subtotal,
                'labor_cost' => $laborCost,
                'grand_total' => $grandTotal,
                'payment_status' => $request->payment_status,
            ]);

            // Replace bill items: delete old, create new
            $bill->items()->delete();

            foreach ($request->items as $item) {
                BillItem::create([
                    'bill_id' => $bill->id,
                    'part_name' => $item['part_name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['quantity'] * $item['price'],
                ]);
            }
        });

        return redirect()->route('bills.show', $bill->id)
            ->with('success', 'Bill updated successfully!');
    }

    /**
     * Delete a bill.
     */
    public function destroy(Bill $bill)
    {
        $bill->delete(); // Cascade deletes bill_items via FK

        return redirect()->route('bills.index')
            ->with('success', 'Bill deleted successfully!');
    }
}
