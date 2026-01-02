<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AGAP | Admin</title>
        
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
                            {{-- Medical Plus Icon from app.blade.php --}}
                            <svg class="w-9 h-9 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-1 11h-4v4h-4v-4H6v-4h4V6h4v4h4v4z"/>
                            </svg>
                            <div class="ml-4">
                                <h1 class="text-2xl tracking-tighter uppercase leading-none">AGAP</h1>
                                <span class="text-[10px] font-black text-red-600 tracking-[0.2em] uppercase">Admin</span>
                            </div>
                        </div>
                    </div>

                    <nav class="flex-1 px-4 space-y-1 overflow-y-auto no-scrollbar pb-4">
                        {{-- Admin Home --}}
                        <a href="{{ route('admin.dashboard') }}" class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-900 shadow-sm' : 'text-gray-500' }}">
                            <div class="w-10 flex-shrink-0 flex items-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </div>
                            <span class="text-[15px] font-bold">Admin Home</span>
                        </a>
                        
                        <div class="pt-6 pb-2 px-4 flex-shrink-0">
                            <p class="text-[11px] font-black text-gray-400 uppercase tracking-[0.15em]">Management</p>
                        </div>
                        
                        {{-- Pending Requests --}}
                        <a href="{{ route('admin.pending') }}" class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.pending') ? 'bg-blue-50 text-blue-900 shadow-sm' : 'text-gray-600' }}">
                            <div class="w-10 flex-shrink-0 flex items-center text-yellow-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-[15px] font-bold">Pending Requests</span>
                        </a>

                        {{-- Manage Doctors --}}
                        <a href="{{ route('admin.doctors') }}" 
                        class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.doctors') ? 'bg-blue-50 text-blue-900 shadow-sm' : 'text-gray-600' }}">
                            <div class="w-10 flex-shrink-0 flex items-center text-blue-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <span class="text-[15px] font-bold">Manage Doctors</span>
                        </a>

                        {{-- Patient Records --}}
                        <a href="{{ route('admin.records') }}" class="nav-link flex items-center px-4 py-3 rounded-xl {{ request()->routeIs('admin.records') ? 'bg-blue-50 text-blue-900 shadow-sm' : 'text-gray-600' }}">
                            <div class="w-10 flex-shrink-0 flex items-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <span class="text-[15px] font-bold">Patient Records</span>
                        </a>
                    </nav>
                </div>

                <div class="border-t border-gray-100 bg-white p-4 pb-6 flex-shrink-0">
                    <div class="px-4 py-2 mb-1">
                        <p class="text-[8px] font-black text-gray-400 uppercase tracking-[0.3em]">Administrator</p>
                        <p class="text-[15px] font-bold text-gray-900 truncate mt-0.5" style="font-weight: 800 !important;">{{ Auth::user()->name }}</p>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link logout-link w-full text-left px-4 py-3 rounded-xl text-red-600">
                            <div class="flex items-center">
                                <div class="w-10 flex-shrink-0 flex items-center"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg></div>
                                <span class="text-[15px] font-bold">Exit Admin Mode</span>
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
                    @yield('content')
                </div>
            </main>
        </div>

        <!-- Scroll to Top Button (admin layout) -->
        <button id="scrollTopBtnAdmin" aria-label="Scroll to top" class="hidden fixed bottom-6 right-6 bg-blue-600 text-white p-3 rounded-full shadow-lg z-50 hover:bg-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3.293 9.293a1 1 0 011.414 0L10 14.586l5.293-5.293a1 1 0 111.414 1.414l-6 6a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
        </button>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var btn = document.getElementById('scrollTopBtnAdmin');
                if (!btn) return;

                window.addEventListener('scroll', function () {
                    if (window.scrollY > 300) btn.classList.remove('hidden'); else btn.classList.add('hidden');
                });

                btn.addEventListener('click', function () { window.scrollTo({ top: 0, behavior: 'smooth' }); });
            });
        </script>
    </body>
</html>