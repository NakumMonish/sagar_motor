<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @if(request()->secure() || request()->header('x-forwarded-proto') === 'https')
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    @endif
    <title>Login — Sagar Motors Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <style>
        /* Base inline layout safety styles in case JS/CSS fails */
        body { margin: 0; font-family: 'Inter', sans-serif; background-color: #0f172a; }
        .logo-img { max-height: 120px; width: auto; max-width: 100%; margin: 0 auto 1rem; display: block; }
    </style>
</head>
<body class="min-h-screen bg-slate-950 font-['Inter',sans-serif] flex items-center justify-center p-4 antialiased selection:bg-amber-500 selection:text-slate-950">
    {{-- Background Decorative Accent --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-amber-600/10 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-slate-800/20 rounded-full blur-3xl"></div>
    </div>

    <div class="w-full max-w-md relative z-10 my-8">
        {{-- Large Prominent Brand Shield Logo --}}
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Sagar Motors Shield Logo"
                 class="logo-img h-32 w-auto mx-auto object-contain drop-shadow-[0_10px_20px_rgba(0,0,0,0.5)] mb-3 hover:scale-105 transition-transform duration-300">
            <h1 class="text-3xl font-black text-white tracking-tight">SAGAR MOTORS</h1>
            <p class="text-xs font-extrabold text-amber-400 uppercase tracking-[0.2em] mt-1">Denting & Painting Specialists</p>
        </div>

        {{-- Login Form Card --}}
        <div class="bg-slate-900/90 backdrop-blur-xl rounded-2xl shadow-2xl border border-slate-800 p-8">
            <div class="mb-6 text-center">
                <h2 class="text-xl font-bold text-white">Admin Portal Sign In</h2>
                <p class="text-xs text-slate-400 mt-1">Enter your login credentials to access garage management</p>
            </div>

            @if($errors->any())
                <div class="mb-5 p-3.5 rounded-xl bg-red-950/60 border border-red-800/60 text-red-300 text-xs font-medium space-y-1">
                    @foreach($errors->all() as $error)
                        <p class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>{{ $error }}</span>
                        </p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email Input --}}
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Email Address</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="admin@sagarmotors.com"
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-11 pr-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 transition-all">
                    </div>
                </div>

                {{-- Password Input with Eye Icon Toggle --}}
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-1.5">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <input type="password" id="password" name="password" required
                               placeholder="••••••••"
                               class="w-full bg-slate-950 border border-slate-800 rounded-xl pl-11 pr-11 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-amber-500/40 focus:border-amber-500 transition-all">
                        {{-- Eye Toggle Button --}}
                        <button type="button" id="toggle-password" tabindex="-1"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-500 hover:text-slate-300 transition-colors focus:outline-none">
                            <svg id="eye-icon-show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg id="eye-icon-hide" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.04 10.04 0 014.122-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m-7.067-7.067a3 3 0 004.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-amber-500 border-slate-800 bg-slate-950 rounded focus:ring-amber-500/40">
                        <span class="text-xs font-semibold text-slate-400">Remember Me</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit"
                        class="w-full py-3.5 px-4 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 text-sm font-extrabold shadow-lg shadow-amber-500/25 hover:shadow-amber-500/40 active:scale-[0.98] transition-all cursor-pointer">
                    Sign In to Dashboard
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-slate-500 mt-6">&copy; {{ date('Y') }} Sagar Motors. All Rights Reserved.</p>
    </div>

    {{-- Eye Icon Toggle Script --}}
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const eyeShow = document.getElementById('eye-icon-show');
            const eyeHide = document.getElementById('eye-icon-hide');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeShow.classList.add('hidden');
                eyeHide.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeShow.classList.remove('hidden');
                eyeHide.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
