@extends('layouts.app')

@section('title', 'Edit Bill — ' . $bill->bill_number)
@section('page-title', 'Edit Bill')
@section('page-subtitle', 'Editing service bill ' . $bill->bill_number)

@section('content')
<form method="POST" action="{{ route('bills.update', $bill) }}" id="bill-form" class="space-y-6">
    @csrf
    @method('PUT')

    {{-- Customer & Vehicle Details --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Customer Details --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Customer Details
            </h3>
            <div class="space-y-4">
                <div>
                    <label for="customer_name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Customer Name <span class="text-red-500">*</span></label>
                    <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name', $bill->customer->name) }}" required
                           class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                </div>
                <div>
                    <label for="mobile" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Mobile Number <span class="text-red-500">*</span></label>
                    <input type="text" id="mobile" name="mobile" value="{{ old('mobile', $bill->customer->mobile) }}" required maxlength="15"
                           class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                </div>
            </div>
        </div>

        {{-- Vehicle Details --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-4-8v16M3 12h18"/></svg>
                Vehicle Details
            </h3>
            <div class="space-y-4">
                <div>
                    <label for="car_number" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Car Number <span class="text-red-500">*</span></label>
                    <input type="text" id="car_number" name="car_number" value="{{ old('car_number', $bill->vehicle->car_number) }}" required
                           class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all uppercase">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="car_name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Car Name <span class="text-red-500">*</span></label>
                        <input type="text" id="car_name" name="car_name" value="{{ old('car_name', $bill->vehicle->car_name) }}" required
                               class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                    </div>
                    <div>
                        <label for="car_model" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Model / Year</label>
                        <input type="text" id="car_model" name="car_model" value="{{ old('car_model', $bill->vehicle->car_model) }}"
                               class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                    </div>
                </div>
                <div>
                    <label for="car_company" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Car Company <span class="text-red-500">*</span></label>
                    <select id="car_company" name="car_company" required
                            class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                        <option value="">Select Company</option>
                        @foreach($carCompanies as $company)
                            <option value="{{ $company->name }}" {{ old('car_company', $bill->vehicle->car_company) == $company->name ? 'selected' : '' }}>{{ $company->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    {{-- Service Type Selection --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Service Type
        </h3>
        <select id="service_type" name="service_type" required
                class="w-full sm:w-72 bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
            <option value="">Select Service Type</option>
            <option value="denting" {{ old('service_type', $bill->service_type) == 'denting' ? 'selected' : '' }}>Denting Work</option>
            <option value="painting" {{ old('service_type', $bill->service_type) == 'painting' ? 'selected' : '' }}>Painting Work</option>
            <option value="general_service" {{ old('service_type', $bill->service_type) == 'general_service' ? 'selected' : '' }}>General Service & Repair</option>
        </select>
    </div>

    {{-- Dynamic Parts/Services Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                Parts / Service Line Items
            </h3>
            <button type="button" onclick="addItemRow()"
                    class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-lg bg-amber-50 text-amber-700 hover:bg-amber-100 border border-amber-200 text-xs font-bold transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Line Item
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full" id="items-table">
                <thead>
                    <tr class="border-b border-gray-200 bg-gray-50 text-left">
                        <th class="px-3 py-2.5 text-xs font-bold text-gray-500 uppercase tracking-wider w-8">#</th>
                        <th class="px-3 py-2.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Part / Service Description</th>
                        <th class="px-3 py-2.5 text-xs font-bold text-gray-500 uppercase tracking-wider w-28">Qty</th>
                        <th class="px-3 py-2.5 text-xs font-bold text-gray-500 uppercase tracking-wider w-36">Rate (₹)</th>
                        <th class="px-3 py-2.5 text-xs font-bold text-gray-500 uppercase tracking-wider w-36">Total (₹)</th>
                        <th class="px-3 py-2.5 w-12"></th>
                    </tr>
                </thead>
                <tbody id="items-body">
                    @foreach($bill->items as $index => $item)
                        <tr class="item-row border-b border-gray-100" data-row="{{ $index }}">
                            <td class="px-3 py-2.5 text-sm text-gray-400 row-number">{{ $index + 1 }}</td>
                            <td class="px-3 py-2.5">
                                <input type="text" name="items[{{ $index }}][part_name]" value="{{ $item->part_name }}" required
                                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500">
                            </td>
                            <td class="px-3 py-2.5">
                                <input type="number" name="items[{{ $index }}][quantity]" value="{{ $item->quantity }}" min="1" required
                                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 item-qty"
                                       onchange="calculateRow(this)" oninput="calculateRow(this)">
                            </td>
                            <td class="px-3 py-2.5">
                                <input type="number" name="items[{{ $index }}][price]" value="{{ $item->price }}" min="0" step="0.01" required
                                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 item-price"
                                       onchange="calculateRow(this)" oninput="calculateRow(this)">
                            </td>
                            <td class="px-3 py-2.5">
                                <span class="text-sm font-bold text-gray-900 row-total">₹{{ number_format($item->total, 2) }}</span>
                            </td>
                            <td class="px-3 py-2.5">
                                <button type="button" onclick="removeItemRow(this)" class="text-gray-400 hover:text-red-600 transition-colors p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Financial Summary & Payment Status --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Totals Calculation --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Financial Summary
            </h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between py-2 border-b border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Subtotal</span>
                    <span id="display-subtotal" class="text-sm font-bold text-gray-900">₹{{ number_format($bill->subtotal, 2) }}</span>
                </div>
                <div>
                    <label for="labor_cost" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">Additional Labor / Extra Charges (₹)</label>
                    <input type="number" id="labor_cost" name="labor_cost" value="{{ old('labor_cost', $bill->labor_cost) }}" min="0" step="0.01"
                           class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all"
                           oninput="calculateTotals()" onchange="calculateTotals()">
                </div>
                <div class="flex items-center justify-between py-3 border-t-2 border-gray-200 mt-2">
                    <span class="text-base font-bold text-gray-900">Grand Total</span>
                    <span id="display-grand-total" class="text-2xl font-extrabold text-amber-600">₹{{ number_format($bill->grand_total, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- Payment Status Radio --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Payment Status
            </h3>
            <div class="space-y-3">
                <label class="flex items-center gap-3 p-3.5 rounded-xl border border-gray-200 hover:border-amber-500/50 cursor-pointer transition-all bg-gray-50/50">
                    <input type="radio" name="payment_status" value="paid" {{ old('payment_status', $bill->payment_status) == 'paid' ? 'checked' : '' }}
                           class="w-4 h-4 text-emerald-600 border-gray-300 focus:ring-emerald-500/50">
                    <div>
                        <span class="text-sm font-bold text-gray-900">Paid</span>
                        <p class="text-xs text-gray-500">Payment received in full from customer</p>
                    </div>
                </label>
                <label class="flex items-center gap-3 p-3.5 rounded-xl border border-gray-200 hover:border-amber-500/50 cursor-pointer transition-all bg-gray-50/50">
                    <input type="radio" name="payment_status" value="pending" {{ old('payment_status', $bill->payment_status) == 'pending' ? 'checked' : '' }}
                           class="w-4 h-4 text-amber-600 border-gray-300 focus:ring-amber-500/50">
                    <div>
                        <span class="text-sm font-bold text-gray-900">Pending</span>
                        <p class="text-xs text-gray-500">Work completed, payment pending</p>
                    </div>
                </label>
            </div>
        </div>
    </div>

    {{-- Submit Buttons --}}
    <div class="flex justify-end gap-3 pt-2">
        <a href="{{ route('bills.show', $bill) }}"
           class="px-6 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">
            Cancel
        </a>
        <button type="submit"
                class="px-8 py-2.5 rounded-lg bg-amber-500 hover:bg-amber-600 text-slate-950 text-sm font-bold shadow-lg shadow-amber-500/25 active:scale-[0.98] transition-all">
            Update Bill
        </button>
    </div>
</form>
@endsection

@section('scripts')
<script>
    let rowCounter = {{ count($bill->items) }};

    function addItemRow() {
        const tbody = document.getElementById('items-body');
        const index = rowCounter++;
        const rowNumber = tbody.querySelectorAll('.item-row').length + 1;

        const tr = document.createElement('tr');
        tr.className = 'item-row border-b border-gray-100';
        tr.dataset.row = index;
        tr.innerHTML = `
            <td class="px-3 py-2.5 text-sm text-gray-400 row-number">${rowNumber}</td>
            <td class="px-3 py-2.5">
                <input type="text" name="items[${index}][part_name]" required
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500"
                       placeholder="e.g. Door Panel Painting">
            </td>
            <td class="px-3 py-2.5">
                <input type="number" name="items[${index}][quantity]" value="1" min="1" required
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 item-qty"
                       onchange="calculateRow(this)" oninput="calculateRow(this)">
            </td>
            <td class="px-3 py-2.5">
                <input type="number" name="items[${index}][price]" value="0" min="0" step="0.01" required
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 item-price"
                       onchange="calculateRow(this)" oninput="calculateRow(this)">
            </td>
            <td class="px-3 py-2.5">
                <span class="text-sm font-bold text-gray-900 row-total">₹0.00</span>
            </td>
            <td class="px-3 py-2.5">
                <button type="button" onclick="removeItemRow(this)" class="text-gray-400 hover:text-red-600 transition-colors p-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </td>
        `;

        tbody.appendChild(tr);
        tr.querySelector('input[type="text"]').focus();
    }

    function removeItemRow(btn) {
        const tbody = document.getElementById('items-body');
        if (tbody.querySelectorAll('.item-row').length <= 1) {
            alert('At least one line item is required.');
            return;
        }
        btn.closest('.item-row').remove();
        updateRowNumbers();
        calculateTotals();
    }

    function updateRowNumbers() {
        const rows = document.querySelectorAll('.item-row');
        rows.forEach((row, i) => {
            row.querySelector('.row-number').textContent = i + 1;
        });
    }

    function calculateRow(input) {
        const row = input.closest('.item-row');
        const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
        const price = parseFloat(row.querySelector('.item-price').value) || 0;
        const total = qty * price;
        row.querySelector('.row-total').textContent = '₹' + total.toFixed(2);
        calculateTotals();
    }

    function calculateTotals() {
        let subtotal = 0;
        document.querySelectorAll('.item-row').forEach(row => {
            const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
            const price = parseFloat(row.querySelector('.item-price').value) || 0;
            subtotal += qty * price;
        });

        const laborCost = parseFloat(document.getElementById('labor_cost').value) || 0;
        const grandTotal = subtotal + laborCost;

        document.getElementById('display-subtotal').textContent = '₹' + subtotal.toFixed(2);
        document.getElementById('display-grand-total').textContent = '₹' + grandTotal.toFixed(2);
    }
</script>
@endsection
