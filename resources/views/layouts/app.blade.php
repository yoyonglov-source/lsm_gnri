<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <style>
            [x-cloak] { display: none !important; }
        </style>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIM LSM GNRI') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-slate-100" x-data="{ sidebarOpen: false }">
        <div class="min-h-screen flex relative">
            
            <!-- BACKDROP OVERLAY UNTUK MOBILE -->
            <div x-show="sidebarOpen" 
                 x-transition:enter="transition-opacity ease-linear duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition-opacity ease-linear duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="sidebarOpen = false" 
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden"
                 style="display: none;"></div>

            <!-- SIDEBAR -->
            <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
                   class="w-64 bg-slate-900 text-slate-200 flex flex-col fixed h-full z-50 shadow-xl border-r border-slate-800 transition-transform duration-300 ease-in-out">
                
                <!-- Logo & Judul Aplikasi -->
                <div class="p-5 flex items-center justify-between border-b border-slate-800 bg-slate-950">
                    <div class="flex items-center gap-3">
                        <span class="text-xl font-black tracking-wider text-emerald-400">GNRI</span>
                        <span class="text-xs font-bold text-slate-400 border-l border-slate-700 pl-2">RIAU</span>
                    </div>
                    <!-- Tombol Silang Tutup Sidebar di HP -->
                    <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white p-1 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Menu Navigasi -->
                <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                    <!-- Kelompok Menu Utama -->
                    <p class="px-3 text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-2">Utama</p>
                    
                    <!-- Dashboard -->
                    @php
                        $isUser = in_array(strtolower(Auth::user()->role), ['user', 'anggota']);
                        $dashboardUrl = $isUser ? route('dashboard') : route('admin.dashboard');
                    @endphp

                    <a href="{{ $dashboardUrl }}" 
                       class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->is('dashboard') || request()->is('admin/dashboard') ? 'bg-emerald-600 text-white font-semibold shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                        <span>Dashboard</span>
                    </a>

                    <!-- KELOMPOK MENU HANYA UNTUK ADMIN / SUPERADMIN / DPD / DPW -->
                    @if(in_array(strtolower(Auth::user()->role), ['admin', 'superadmin', 'admin_dpw', 'admin_dpd']))
                        <div class="pt-4 mt-4 border-t border-slate-800/80"></div>
                        <p class="px-3 text-[10px] font-semibold text-slate-500 uppercase tracking-wider mb-2">Manajemen LSM</p>
                        
                        <!-- Menu Data Anggota -->
                        <a href="{{ route('admin.anggota.index') }}" 
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.anggota.*') ? 'bg-emerald-600 text-white font-semibold shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span>Data Anggota</span>
                        </a>

                        <!-- Verifikasi Anggota -->
                        <a href="{{ route('admin.verifikasi.index') }}" 
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.verifikasi.*') ? 'bg-emerald-600 text-white font-semibold shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Verifikasi Anggota</span>
                        </a>

                        <!-- Menu Setting Sekretariat / Wilayah -->
                        <a href="{{ route('admin.kabupaten.index') }}" 
                           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 {{ request()->routeIs('admin.kabupaten.*') ? 'bg-emerald-600 text-white font-semibold shadow-lg shadow-emerald-900/30' : 'text-slate-400 hover:bg-slate-800 hover:text-white' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span>Data Sekretariat Daerah</span>
                        </a>
                    @endif
                </nav>

                <!-- Info Akun Bawah & Logout -->
                <div class="p-4 border-t border-slate-800 bg-slate-950/50 flex flex-col gap-2">
                    <div class="px-2">
                        <p class="text-xs font-semibold text-slate-200 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-slate-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="w-full mt-1">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center gap-2 px-2.5 py-2 text-xs font-medium text-rose-400 hover:bg-rose-950/30 hover:text-rose-300 rounded-lg transition-all">
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <span>Keluar Sistem</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- KONTEN UTAMA -->
            <div class="flex-1 lg:pl-64 flex flex-col min-h-screen w-full transition-all duration-300">
                <!-- Topbar Minimalis -->
                <header class="bg-white border-b border-slate-200 sticky top-0 z-40 px-4 sm:px-6 py-3.5 flex items-center justify-between shadow-sm">
                    <div class="flex items-center gap-3">
                        <!-- Tombol Hamburger Menu (Hanya Muncul di Mobile/Tablet) -->
                        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-slate-600 hover:text-slate-900 p-2 rounded-xl border border-slate-200 hover:bg-slate-50 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                        </button>

                        <div>
                            {{ $header ?? '' }}
                        </div>
                    </div>

                    <!-- Tanggal (Hanya Muncul di Sm/Desktop) -->
                    <div class="hidden sm:block text-xs sm:text-sm font-semibold text-slate-600 bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-200">
                        {{ now()->translatedFormat('d F Y') }}
                    </div>
                </header>

                <!-- Isi Halaman Utama -->
                <main class="flex-1 p-4 sm:p-6">
                    {{ $slot }}
                </main>
            </div>

        </div>
    </body>
</html>