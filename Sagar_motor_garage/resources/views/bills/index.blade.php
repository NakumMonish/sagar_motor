@extends('layouts.app')

@section('title', 'Bill Records — Sagar Motors')
@section('page-title', 'Bill Records')
@section('page-subtitle', 'Manage and track all generated service bills')

@section('content')
<div class="space-y-6">
    {{-- Top Action & Search Bar Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
        <form method="GET" action="{{ route('bills.index') }}" class="flex flex-col md:flex-row gap-4 justify-between items-center">
            {{-- Search Input --}}
            <div class="relative w-full md:w-96">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search by Customer or Car No..."
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg pl-10 pr-4 py-2 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
            </div>

            {{-- Filters & Actions --}}
            <div class="flex items-center gap-3 w-full md:w-auto">
                <select name="status" onchange="this.form.submit()"
                        class="bg-gray-50 border border-gray-300 rounded-lg px-3.5 py-2 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-amber-500/50 transition-all">
                    <option value="">All Payment Status</option>
                    <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>

                @if(request('search') || request('status'))
                    <a href="{{ route('bills.index') }}" class="px-3 py-2 text-xs font-semibold text-gray-500 hover:text-gray-700 underline">
                        Clear Filters
                    </a>
                @endif

                <a href="{{ route('bills.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 text-xs font-bold rounded-lg shadow-sm transition-all shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Bill
                </a>
            </div>
        </form>
    </div>

    {{-- Data Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-500 text-xs font-semibold uppercase tracking-wider border-b border-gray-200">
                        <th class="px-5 py-3.5">Bill No</th>
                        <th class="px-5 py-3.5">Date</th>
                        <th class="px-5 py-3.5">Customer Details</th>
                        <th class="px-5 py-3.5">Vehicle Info</th>
                        <th class="px-5 py-3.5">Service Type</th>
                        <th class="px-5 py-3.5 text-right">Grand Total</th>
                        <th class="px-5 py-3.5 text-center">Status</th>
                        <th class="px-5 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($bills as $bill)
                        <tr class="hover:bg-gray-50/80 transition-colors">
                            <td class="px-5 py-4 font-bold text-amber-600 font-mono text-xs">
                                <a href="{{ route('bills.show', $bill) }}" class="hover:underline">{{ $bill->bill_number }}</a>
                            </td>
                            <td class="px-5 py-4 text-xs font-medium text-gray-500">
                                {{ $bill->bill_date->format('d M, Y') }}
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-bold text-gray-900">{{ $bill->customer->name }}</p>
                                <p class="text-xs text-gray-500">{{ $bill->customer->mobile }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <p class="font-mono font-bold text-xs text-gray-800">{{ $bill->vehicle->car_number }}</p>
                                <p class="text-xs text-gray-500">{{ $bill->vehicle->car_company }} {{ $bill->vehicle->car_name }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-700">
                                    {{ $bill->service_type_label }}
                                </span>
                            </td>
                            <td class="px-5 py-4 text-right font-extrabold text-gray-900">
                                ₹{{ number_format($bill->grand_total, 2) }}
                            </td>
                            <td class="px-5 py-4 text-center">
                                @if($bill->payment_status === 'paid')
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">Paid</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 border border-amber-200">Pending</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('bills.show', $bill) }}" title="View Invoice"
                                       class="p-1.5 text-gray-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('bills.edit', $bill) }}" title="Edit Bill"
                                       class="p-1.5 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('bills.destroy', $bill) }}" onsubmit="return confirm('Are you sure you want to delete this bill record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete Bill"
                                                class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-10 text-center text-gray-400 text-sm">
                                No bill records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($bills->hasPages())
            <div class="p-4 border-t border-gray-200 bg-gray-50">
                {{ $bills->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
