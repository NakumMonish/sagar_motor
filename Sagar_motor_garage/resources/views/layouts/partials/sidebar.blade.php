{{-- Sidebar Navigation --}}
<aside class="fixed top-0 left-0 w-64 h-screen bg-garage-800 border-r border-garage-700 flex flex-col z-40">
    {{-- Branding --}}
    <div class="p-5 border-b border-garage-700">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-accent-500 flex items-center justify-center">
                <svg class="w-6 h-6 text-garage-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-accent-400 tracking-wide">SAGAR MOTORS</h2>
                <p class="text-[10px] text-garage-400 uppercase tracking-widest">Denting & Painting</p>
            </div>
        </div>
    </div>

    {{-- Navigation Links --}}
    <nav class="flex-1 py-4 px-3 space-y-1 overflow-y-auto">
        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                  {{ request()->routeIs('dashboard') ? 'bg-accent-500/15 text-accent-400 border-l-2 border-accent-500' : 'text-garage-300 hover:bg-garage-700 hover:text-garage-100' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            Dashboard
        </a>

        {{-- Bill Management Dropdown --}}
        <div x-data="{ billOpen: {{ request()->routeIs('bills.*') ? 'true' : 'false' }} }">
            <button id="bill-menu-toggle" onclick="toggleBillMenu()"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200
                           {{ request()->routeIs('bills.*') ? 'text-accent-400' : 'text-garage-300 hover:bg-garage-700 hover:text-garage-100' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Bill Management
                </div>
                <svg id="bill-menu-chevron" class="w-4 h-4 transition-transform duration-200 {{ request()->routeIs('bills.*') ? 'rotate-180' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div id="bill-submenu" class="{{ request()->routeIs('bills.*') ? '' : 'hidden' }} ml-5 mt-1 space-y-1 border-l border-garage-600 pl-3">
                <a href="{{ route('bills.create') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-all duration-200
                          {{ request()->routeIs('bills.create') ? 'bg-accent-500/15 text-accent-400' : 'text-garage-400 hover:bg-garage-700 hover:text-garage-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Generate Bill
                </a>
                <a href="{{ route('bills.index') }}"
                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition-all duration-200
                          {{ request()->routeIs('bills.index') ? 'bg-accent-500/15 text-accent-400' : 'text-garage-400 hover:bg-garage-700 hover:text-garage-100' }}">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Bill Records
                </a>
            </div>
        </div>
    </nav>

    {{-- Sidebar Footer --}}
    <div class="p-4 border-t border-garage-700">
        <div class="flex items-center gap-2 text-xs text-garage-500">
            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
            System Online
        </div>
    </div>
</aside>

<script>
    function toggleBillMenu() {
        const submenu = document.getElementById('bill-submenu');
        const chevron = document.getElementById('bill-menu-chevron');
        submenu.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
    }
</script>
