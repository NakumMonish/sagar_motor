@extends('layouts.app')

@section('title', 'Invoice — ' . $bill->bill_number)
@section('page-title', 'Invoice Details')
@section('page-subtitle', $bill->bill_number)

@section('content')
<div class="space-y-4">
    {{-- Action Bar --}}
    <div class="no-print flex items-center gap-3">
        <a href="{{ route('bills.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors shadow-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Back to Records
        </a>
        <button onclick="window.print()"
                class="inline-flex items-center gap-2 px-5 py-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-slate-950 text-sm font-bold transition-all shadow-md shadow-amber-500/20 active:scale-[0.98]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Print Color Invoice
        </button>
        <a href="{{ route('bills.edit', $bill) }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-colors shadow-xs">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            Edit
        </a>
    </div>

    {{-- Invoice Card --}}
    <div class="print-container bg-white rounded-2xl border border-gray-200 max-w-4xl mx-auto shadow-xl overflow-hidden">
        {{-- Invoice Header with Logo & Shop Info --}}
        <div class="p-8 border-b border-gray-200 bg-gradient-to-r from-slate-900 via-slate-900 to-slate-800 text-white relative">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                <div class="flex items-center gap-4 text-center sm:text-left">
                    <img src="{{ asset('images/logo.png') }}" alt="Sagar Motors Shield Logo" class="h-20 w-auto object-contain drop-shadow-md">
                    <div>
                        <h1 class="text-3xl font-extrabold tracking-wide text-amber-400">SAGAR MOTORS</h1>
                        <p class="text-sm font-semibold text-slate-300">Denting & Painting Specialists</p>
                        <p class="text-xs text-slate-400 mt-1">PANCHRATNA CHAMBER 8-A NATIONAL HIGHWAY, TRAJPAR CHAR RASTA, MORBI-2</p>
                        <p class="text-xs text-slate-400">Mobile: <span class="text-amber-400 font-bold">96624 04285</span></p>
                    </div>
                </div>
                <div class="text-center sm:text-right border-t sm:border-t-0 sm:border-l border-slate-700 pt-4 sm:pt-0 sm:pl-6">
                    <span class="inline-block px-3 py-1 bg-amber-500/20 border border-amber-400/40 text-amber-300 rounded-full text-xs font-bold uppercase tracking-wider mb-2">Invoice</span>
                    <p class="text-xs text-slate-400">Invoice No</p>
                    <p class="text-xl font-extrabold text-white font-mono tracking-wider">{{ $bill->bill_number }}</p>
                    <p class="text-xs text-slate-400 mt-1">Date: <span class="text-slate-200 font-semibold">{{ $bill->bill_date->format('d/m/Y') }}</span></p>
                </div>
            </div>
        </div>

        {{-- Customer & Vehicle Details Grid --}}
        <div class="p-8 grid grid-cols-1 sm:grid-cols-2 gap-6 border-b border-gray-200 bg-gray-50/50">
            {{-- Customer --}}
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Customer Details
                </h3>
                <div class="space-y-2 text-sm">
                    <div class="flex">
                        <span class="text-gray-500 w-24">Name</span>
                        <span class="text-gray-900 font-bold">: {{ $bill->customer->name }}</span>
                    </div>
                    <div class="flex">
                        <span class="text-gray-500 w-24">Mobile</span>
                        <span class="text-gray-900 font-medium">: {{ $bill->customer->mobile }}</span>
                    </div>
                </div>
            </div>

            {{-- Vehicle --}}
            <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-xs">
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-4-8v16M3 12h18"/></svg>
                    Vehicle Details
                </h3>
                <div class="space-y-2 text-sm">
                    <div class="flex">
                        <span class="text-gray-500 w-24">Car No.</span>
                        <span class="text-amber-600 font-mono font-bold">: {{ $bill->vehicle->car_number }}</span>
                    </div>
                    <div class="flex">
                        <span class="text-gray-500 w-24">Car</span>
                        <span class="text-gray-900 font-semibold">: {{ $bill->vehicle->car_company }} {{ $bill->vehicle->car_name }}</span>
                    </div>
                    @if($bill->vehicle->car_model)
                    <div class="flex">
                        <span class="text-gray-500 w-24">Model</span>
                        <span class="text-gray-800">: {{ $bill->vehicle->car_model }}</span>
                    </div>
                    @endif
                    <div class="flex">
                        <span class="text-gray-500 w-24">Service</span>
                        <span class="text-gray-900 font-medium">: {{ $bill->service_type_label }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Itemized Service Charges Table --}}
        <div class="p-8 border-b border-gray-200">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Service Charges Breakdown</h3>
            <table class="w-full text-left border-collapse print-table">
                <thead>
                    <tr class="bg-slate-900 text-white rounded-lg">
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider rounded-l-lg w-10">#</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider">Part / Service Description</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-center w-20">Qty</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-right w-32">Rate (₹)</th>
                        <th class="px-4 py-3 text-xs font-bold uppercase tracking-wider text-right rounded-r-lg w-32">Amount (₹)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($bill->items as $index => $item)
                        <tr class="hover:bg-gray-50/50">
                            <td class="px-4 py-3.5 text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-4 py-3.5 text-sm text-gray-900 font-medium">{{ $item->part_name }}</td>
                            <td class="px-4 py-3.5 text-sm text-gray-700 text-center">{{ $item->quantity }}</td>
                            <td class="px-4 py-3.5 text-sm text-gray-700 text-right">{{ number_format($item->price, 2) }}</td>
                            <td class="px-4 py-3.5 text-sm text-gray-900 text-right font-bold">{{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Totals & Payment Badge --}}
        <div class="p-8 bg-gray-50/30">
            <div class="flex justify-end">
                <div class="w-80 space-y-2.5">
                    <div class="flex items-center justify-between text-sm py-1">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="text-gray-900 font-bold">₹{{ number_format($bill->subtotal, 2) }}</span>
                    </div>
                    @if($bill->labor_cost > 0)
                    <div class="flex items-center justify-between text-sm py-1">
                        <span class="text-gray-600">Additional Labor / Extra</span>
                        <span class="text-gray-900 font-bold">₹{{ number_format($bill->labor_cost, 2) }}</span>
                    </div>
                    @endif
                    <div class="flex items-center justify-between py-3 border-t-2 border-gray-900 mt-2">
                        <span class="text-base font-extrabold text-gray-900">Grand Total</span>
                        <span class="text-2xl font-black text-amber-600">₹{{ number_format($bill->grand_total, 2) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm pt-2">
                        <span class="text-gray-600 font-medium">Payment Status</span>
                        <span>
                            @if($bill->payment_status === 'paid')
                                <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-300">PAID</span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-extrabold bg-amber-100 text-amber-800 border border-amber-300">PENDING</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Invoice Footer --}}
        <div class="px-8 py-6 border-t border-gray-200 text-center bg-gray-50">
            <p class="text-xs font-semibold text-gray-600">Thank you for choosing Sagar Motors!</p>
            <p class="text-xs text-gray-400 mt-1">This is a computer-generated invoice.</p>
        </div>
    </div>
</div>
@endsection
