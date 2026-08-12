@extends('layouts.app')

@section('title', 'Dashboard — Sagar Motors')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Sagar Motors Denting & Painting Admin Summary')

@section('content')
<div class="space-y-6">
    {{-- Metric Stat Cards Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        {{-- Total Revenue Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Revenue</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">₹{{ number_format($totalRevenue, 2) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3 flex items-center gap-1">
                <span class="text-emerald-600 font-semibold">Collected</span> from paid bills
            </p>
        </div>

        {{-- Pending Payments Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Pending Payments</p>
                    <h3 class="text-2xl font-bold text-amber-600 mt-1">₹{{ number_format($pendingPayments, 2) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3">Outstanding balance</p>
        </div>

        {{-- Total Bills Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Service Bills</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalBills) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3">Generated bills count</p>
        </div>

        {{-- Total Customers Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Active Customers</p>
                    <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($totalCustomers) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3">Registered vehicle owners</p>
        </div>
    </div>

    {{-- Recent Bills Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-base font-bold text-gray-900">Recent Service Bills</h3>
                <p class="text-xs text-gray-500">Latest job cards and invoicing records</p>
            </div>
            <a href="{{ route('bills.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 text-xs font-semibold rounded-lg shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Create New Bill
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider border-b border-gray-200">
                        <th class="px-5 py-3">Bill No</th>
                        <th class="px-5 py-3">Customer</th>
                        <th class="px-5 py-3">Car Details</th>
                        <th class="px-5 py-3">Service</th>
                        <th class="px-5 py-3 text-right">Amount (₹)</th>
                        <th class="px-5 py-3 text-center">Status</th>
                        <th class="px-5 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($recentBills as $bill)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-5 py-3.5 font-bold text-amber-600 font-mono text-xs">
                                <a href="{{ route('bills.show', $bill) }}" class="hover:underline">{{ $bill->bill_number }}</a>
                            </td>
                            <td class="px-5 py-3.5">
                                <p class="font-medium text-gray-900">{{ $bill->customer->name }}</p>
                                <p class="text-xs text-gray-400">{{ $bill->customer->mobile }}</p>
                            </td>
                            <td class="px-5 py-3.5">
                                <p class="font-semibold text-gray-800 font-mono text-xs">{{ $bill->vehicle->car_number }}</p>
                                <p class="text-xs text-gray-500">{{ $bill->vehicle->car_company }} {{ $bill->vehicle->car_name }}</p>
                            </td>
                            <td class="px-5 py-3.5">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                    {{ $bill->service_type_label }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-right font-bold text-gray-900">
                                ₹{{ number_format($bill->grand_total, 2) }}
                            </td>
                            <td class="px-5 py-3.5 text-center">
                                @if($bill->payment_status === 'paid')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">Paid</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200">Pending</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <a href="{{ route('bills.show', $bill) }}" class="text-xs font-semibold text-amber-600 hover:text-amber-700">View Invoice &rarr;</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-8 text-center text-gray-400 text-sm">
                                No bills generated yet. Click "Create New Bill" to start.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
