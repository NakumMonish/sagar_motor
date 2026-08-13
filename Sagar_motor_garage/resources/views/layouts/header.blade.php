{{-- Header Component --}}
<header class="bg-white border-b border-gray-200 px-4 sm:px-6 py-4 flex items-center justify-between no-print sticky top-0 z-30 shadow-xs">
    {{-- Left: Mobile Menu Toggle + Page Title --}}
    <div class="flex items-center gap-3">
        {{-- Mobile Hamburger Button --}}
        <button id="mobile-menu-btn" class="lg:hidden p-2 -ml-1 text-gray-600 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" onclick="toggleSidebar()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <div>
            <h2 class="text-lg sm:text-xl font-bold text-gray-900 tracking-tight">@yield('page-title', 'Dashboard')</h2>
            <p class="text-xs text-gray-500 font-medium hidden sm:block">@yield('page-subtitle', 'Sagar Motors Management System')</p>
        </div>
    </div>

    {{-- Admin Profile & Date --}}
    <div class="flex items-center gap-3 sm:gap-6">
        <div class="hidden sm:block text-right">
            <p class="text-xs text-gray-400 font-medium">Today's Date</p>
            <p class="text-sm font-semibold text-gray-700">{{ date('d M, Y') }}</p>
        </div>

        {{-- Admin Avatar --}}
        <div class="relative flex items-center gap-3 pl-3 sm:pl-4 border-l border-gray-200">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 sm:gap-3 group">
                <div class="w-9 h-9 rounded-full bg-amber-500 text-slate-950 flex items-center justify-center font-bold text-sm shadow-sm group-hover:bg-amber-600 transition-colors">
                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="hidden md:block text-left">
                    <p class="text-sm font-semibold text-gray-800 group-hover:text-amber-600 transition-colors">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-gray-400">Administrator</p>
                </div>
            </a>

            {{-- Logout Button (POST form for CSRF) --}}
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" title="Logout"
                   class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors flex items-center gap-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </div>
</header>

