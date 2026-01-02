<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AGAP</title>
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800,900&display=swap" rel="stylesheet" />
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body { font-family: 'Figtree', sans-serif !important; }
            .navy-branding { color: #000080 !important; font-weight: 900 !important; } 
            .nav-link { transition: all 0.2s ease-in-out; }
            .nav-link:not(.logout-link):hover { transform: translateX(6px); background-color: #f8fafc !important; color: #000080 !important; }
            .logout-link:hover { transform: translateX(6px); background-color: #fff5f5 !important; color: #dc2626 !important; }
            
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        </style>
    </head>
    <body class="antialiased bg-gray-100"> 
        <div class="flex h-screen w-full">
            
            <aside class="w-72 bg-white flex flex-col border-r border-gray-200 shadow-sm z-10 flex-shrink-0">
                <div class="flex-1 flex flex-col min-h-0">
                    <div class="p-6 mb-2 flex-shrink-0">
                        <div class="flex items-center navy-branding"> 
                            <svg class="w-9 h-9 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 11h-4v4h-4v-4H6v-4h4V6h4v4h4v4z"/>
                            </svg>
                            <h1 class="ml-4 text-2xl tracking-tighter uppercase">AGAP</h1>
                        </div>
                    </div>

                    <nav class="flex-1 px-4 space-y-1 overflow-y-auto no-scrollbar pb-4">
                        {{-- Dashboard --}}
                        <a href="{{ route('dashboard') }}" class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-900 shadow-sm' : 'text-gray-500' }}">
                            <div class="w-10 flex-shrink-0 flex items-center"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg></div>
                            <span class="text-[15px] font-bold">Dashboard</span>
                        </a>
                        
                        <div class="pt-6 pb-2 px-4 flex-shrink-0">
                            <p class="text-[11px] font-black text-gray-400 uppercase tracking-[0.15em]">Appointments</p>
                        </div>
                        
                        {{-- New Appointment --}}
                        <a href="{{ route('department.index') }}" class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('department.index') ? 'bg-blue-50 text-blue-900 shadow-sm' : 'text-gray-600' }}">
                            <span class="text-[15px] font-bold ml-10">Request New Appointment</span>
                        </a>

                        {{-- Changed to Medical History --}}
                        <a href="{{ route('medical.history') }}" class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('medical.history') ? 'bg-blue-50 text-blue-900 shadow-sm' : 'text-gray-600' }}">
                            <span class="text-[15px] font-bold ml-10">My Appointments</span>
                        </a>
                    </nav>
                </div>

                <div class="border-t border-gray-100 bg-white p-4 pb-6 flex-shrink-0">
                    <div class="px-4 py-2 mb-1">
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-[0.3em]">Account</p>
                        <p class="text-[15px] font-bold text-gray-900 truncate mt-0.5" style="font-weight: 800 !important;">{{ Auth::user()->name }}</p>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="nav-link flex items-center px-4 py-3 rounded-xl text-gray-600">
                        <div class="w-10 flex-shrink-0 flex items-center"><svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg></div>
                        <span class="text-[15px] font-bold">Profile Settings</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link logout-link w-full text-left px-4 py-3 rounded-xl text-red-600">
                            <div class="flex items-center">
                                <div class="w-10 flex-shrink-0 flex items-center"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg></div>
                                <span class="text-[15px] font-bold">Log Out</span>
                            </div>
                        </button>
                    </form>
                </div>
            </aside>

            <main class="flex-1 h-full overflow-y-auto no-scrollbar scroll-smooth">
                @isset($header)
                    <header class="bg-white shadow-sm border-b border-gray-100">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset
                
                <div class="min-h-full">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <!-- Scroll to Top Button (visible after scrolling) -->
        <button id="scrollTopBtn" aria-label="Scroll to top" class="hidden fixed bottom-6 right-6 bg-blue-600 text-white p-3 rounded-full shadow-lg z-50 hover:bg-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.293 9.293a1 1 0 011.414 0L10 14.586l5.293-5.293a1 1 0 111.414 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var btn = document.getElementById('scrollTopBtn');
                if (!btn) return;

                // Show button after user scrolls down 300px
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 300) {
                        btn.classList.remove('hidden');
                    } else {
                        btn.classList.add('hidden');
                    }
                });

                // Smooth scroll to top
                btn.addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });
        </script>
    </body>
</html>