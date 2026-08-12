@extends('layouts.app')

@section('title', 'Admin Profile — Sagar Motors')
@section('page-title', 'Admin Settings')
@section('page-subtitle', 'Update administrator profile credentials and login password')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
        <h3 class="text-lg font-semibold text-gray-900 mb-6 pb-4 border-b border-gray-100 flex items-center gap-2">
            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            Edit Account Credentials
        </h3>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1.5">Admin Name <span class="text-red-500">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}" required
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                @error('name')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address <span class="text-red-500">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}" required
                       class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                @error('email')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="pt-4 border-t border-gray-100">
                <h4 class="text-sm font-semibold text-gray-800 mb-1">Change Password</h4>
                <p class="text-xs text-gray-500 mb-4">Leave password fields blank if you do not want to change your password.</p>

                <div class="space-y-4">
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">New Password</label>
                        <input type="password" id="password" name="password" placeholder="Minimum 6 characters"
                               class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1.5">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Re-type new password"
                               class="w-full bg-gray-50 border border-gray-300 rounded-lg px-4 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-amber-500/50 focus:border-amber-500 transition-all">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="submit"
                        class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-slate-950 text-sm font-semibold rounded-lg shadow-md transition-all">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
