@extends('layouts.app')

@section('title', 'Car Companies — Sagar Motors')
@section('page-title', 'Car Companies')
@section('page-subtitle', 'Manage vehicle manufacturers for service billing')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Add New Company Form --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Car Company
            </h3>
            <form method="POST" action="{{ route('car-companies.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Company / Brand Name <span class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="e.g. Toyota, Tata, Maruti"
                           class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                        class="w-full py-2.5 px-4 bg-amber-500 hover:bg-amber-600 text-slate-950 text-sm font-semibold rounded-lg shadow-sm transition-all">
                    Save Company
                </button>
            </form>
        </div>
    </div>

    {{-- Company List Table --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 border-b border-gray-200 bg-gray-50 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-800">All Car Companies ({{ count($companies) }})</h3>
            </div>

            <div class="divide-y divide-gray-100 max-h-[600px] overflow-y-auto">
                @forelse($companies as $company)
                    <div class="p-4 flex items-center justify-between hover:bg-gray-50/80 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr($company->name, 0, 1)) }}
                            </div>
                            <div>
                                <span class="text-sm font-semibold text-gray-900">{{ $company->name }}</span>
                                <p class="text-xs text-gray-400">Added {{ $company->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <form method="POST" action="{{ route('car-companies.destroy', $company) }}" onsubmit="return confirm('Delete this company?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 transition-colors rounded-lg hover:bg-red-50">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-400 text-sm">
                        No car companies found. Add one above.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
