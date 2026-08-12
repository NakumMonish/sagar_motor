{{-- Top Header Bar --}}
<header class="bg-garage-800 border-b border-garage-700 px-6 py-4 flex items-center justify-between sticky top-0 z-30">
    {{-- Page Title --}}
    <div>
        <h1 class="text-lg font-semibold text-garage-100">@yield('page-title', 'Dashboard')</h1>
        <p class="text-xs text-garage-400 mt-0.5">@yield('page-subtitle', 'Welcome back, Admin')</p>
    </div>

    {{-- Right Side: Profile Dropdown --}}
    <div class="relative" x-data="{ open: false }">
        <button id="profile-dropdown-btn" onclick="toggleProfileDropdown()" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-garage-700 transition-colors">
            <div class="w-8 h-8 rounded-full bg-accent-500 flex items-center justify-center text-sm font-bold text-garage-900">
                {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div class="text-left hidden sm:block">
                <p class="text-sm font-medium text-garage-100">{{ Auth::user()->name }}</p>
                <p class="text-xs text-garage-400">Administrator</p>
            </div>
            <svg class="w-4 h-4 text-garage-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
        </button>

        {{-- Dropdown Menu --}}
        <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 rounded-lg bg-garage-700 border border-garage-600 shadow-xl py-1 z-50">
            <div class="px-4 py-2 border-b border-garage-600">
                <p class="text-sm font-medium text-garage-100">{{ Auth::user()->name }}</p>
                <p class="text-xs text-garage-400">{{ Auth::user()->email }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-400 hover:bg-garage-600 flex items-center gap-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>

<script>
    function toggleProfileDropdown() {
        const dropdown = document.getElementById('profile-dropdown');
        dropdown.classList.toggle('hidden');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        const btn = document.getElementById('profile-dropdown-btn');
        const dropdown = document.getElementById('profile-dropdown');
        if (btn && dropdown && !btn.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
</script>
