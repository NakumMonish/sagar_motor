{{-- Mobile Sidebar Overlay Backdrop --}}
<div id="sidebar-backdrop" class="fixed inset-0 bg-black/50 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>

{{-- Sidebar Component --}}
<aside id="app-sidebar" class="fixed lg:static w-64 h-screen bg-slate-900 border-r border-slate-800 text-slate-300 flex flex-col justify-between shrink-0 overflow-y-auto no-print shadow-xl z-50 transition-transform duration-300 -translate-x-full lg:translate-x-0">
    <div>
        {{-- Brand Logo Header --}}
        <div class="p-6 border-b border-slate-800 text-center bg-slate-950/50 sticky top-0 z-10">
            {{-- Mobile Close Button --}}
            <button class="lg:hidden absolute top-3 right-3 p-1.5 text-slate-400 hover:text-white hover:bg-slate-800 rounded-lg transition-colors" onclick="toggleSidebar()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <a href="{{ route('dashboard') }}" class="block group">
                <img src="{{ asset('images/logo.png') }}" alt="Sagar Motors Shield Logo"
                     class="h-20 w-auto mx-auto object-contain drop-shadow-md group-hover:scale-105 transition-transform duration-200">
                <h1 class="font-extrabold text-white text-lg tracking-wide leading-tight mt-2.5">SAGAR MOTORS</h1>
                <p class="text-[11px] text-amber-400 font-bold tracking-widest uppercase mt-0.5">Denting & Painting</p>
            </a>
        </div>

        {{-- Navigation Links --}}
        <nav class="p-4 space-y-1.5 text-sm font-medium">
            <a href="{{ route('dashboard') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all {{ request()->routeIs('dashboard') ? 'bg-amber-500 text-slate-950 font-semibold shadow-md shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                <span>Dashboard</span>
            </a>

            {{-- Bill Management Group --}}
            <div class="pt-3 pb-1">
                <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Bill Management</p>
            </div>

            <a href="{{ route('bills.create') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all {{ request()->routeIs('bills.create') ? 'bg-amber-500 text-slate-950 font-semibold shadow-md shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Generate Bill</span>
            </a>

            <a href="{{ route('bills.index') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all {{ request()->routeIs('bills.index') || request()->routeIs('bills.show') || request()->routeIs('bills.edit') ? 'bg-amber-500 text-slate-950 font-semibold shadow-md shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Bill Records</span>
            </a>

            {{-- Settings Group --}}
            <div class="pt-4 pb-1">
                <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-wider">Master Setup</p>
            </div>

            <a href="{{ route('car-companies.index') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all {{ request()->routeIs('car-companies.*') ? 'bg-amber-500 text-slate-950 font-semibold shadow-md shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h8m-8 4h8m-4-8v16M3 12h18"/></svg>
                <span>Car Companies</span>
            </a>

            <a href="{{ route('profile.edit') }}"
               class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all {{ request()->routeIs('profile.*') ? 'bg-amber-500 text-slate-950 font-semibold shadow-md shadow-amber-500/20' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Admin Profile</span>
            </a>
        </nav>
    </div>

    {{-- System Footer Info --}}
    <div class="p-4 border-t border-slate-800 text-xs text-slate-500">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <span class="text-slate-400 font-medium">Sagar Motors Admin</span>
        </div>
    </div>
</aside>

{{-- Sidebar Toggle Script --}}
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('app-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    }
</script>

