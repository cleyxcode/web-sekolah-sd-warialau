<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — SD Negeri Warialau</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-scrollbar::-webkit-scrollbar { width: 4px; }
        .sidebar-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 2px; }
    </style>
</head>
<body class="h-full bg-[#f1f5f9] font-sans antialiased" x-data="adminLayout()" x-cloak>

    {{-- Mobile Overlay --}}
    <div x-show="sidebarOpen" x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-20 bg-black/60 backdrop-blur-sm lg:hidden"></div>

    {{-- ======== SIDEBAR ======== --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed top-0 left-0 z-30 h-full w-[260px] flex flex-col
               bg-[#0f172a] transition-transform duration-300 ease-in-out lg:translate-x-0 shadow-xl">

        {{-- Brand --}}
        <div class="flex items-center gap-3 px-5 h-16 border-b border-white/[0.07] shrink-0">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center shadow-lg shrink-0">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="text-white font-bold text-sm tracking-tight truncate">SD Negeri Warialau</p>
                <p class="text-slate-400 text-[11px] truncate">Panel Admin</p>
            </div>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 overflow-y-auto sidebar-scrollbar px-3 py-4 space-y-0.5">

            @php
                $menuGroups = [
                    'MENU' => [
                        ['route' => 'admin.dashboard', 'label' => 'Dashboard',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v5a1 1 0 01-1 1H5a1 1 0 01-1-1V5zm10 0a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zm10-3a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"/>'],
                        ['route' => 'admin.profil-sekolah.edit', 'label' => 'Profil Sekolah',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>'],
                    ],
                    'KELOLA' => [
                        ['route' => 'admin.guru.index', 'label' => 'Data Guru',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>'],
                        ['route' => 'admin.siswa.index', 'label' => 'Data Siswa',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>'],
                        ['route' => 'admin.berita.index', 'label' => 'Berita & Pengumuman',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>'],
                        ['route' => 'admin.galeri.index', 'label' => 'Galeri Foto',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>'],
                    ],
                    'PENDAFTARAN' => [
                        ['route' => 'admin.info-pendaftaran.index', 'label' => 'Info Pendaftaran',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>'],
                        ['route' => 'admin.pendaftaran.index', 'label' => 'Data Formulir',
                         'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>'],
                    ],
                ];
            @endphp

            @foreach ($menuGroups as $groupLabel => $items)
                <div class="pt-3 pb-1">
                    <p class="px-3 text-[10px] font-semibold text-slate-500 uppercase tracking-widest mb-1">
                        {{ $groupLabel }}
                    </p>
                    @foreach ($items as $item)
                        @php
                            $active = request()->routeIs(
                                str_replace(['.index', '.edit'], '', $item['route']) . '*'
                            );
                        @endphp
                        <a href="{{ route($item['route']) }}"
                           class="relative flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all duration-150 group
                                  {{ $active
                                    ? 'bg-blue-600 text-white shadow-md shadow-blue-900/30'
                                    : 'text-slate-400 hover:bg-white/[0.06] hover:text-slate-200' }}">
                            <svg class="w-[18px] h-[18px] shrink-0 transition-colors {{ $active ? 'text-white' : 'text-slate-500 group-hover:text-slate-300' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                {!! $item['icon'] !!}
                            </svg>
                            <span class="truncate">{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            @endforeach
        </nav>

        {{-- User profile --}}
        <div class="shrink-0 px-3 py-4 border-t border-white/[0.07]" x-data="{ open: false }">
            <button @click="open = !open"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-white/[0.06] transition group">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="min-w-0 flex-1 text-left">
                    <p class="text-slate-200 text-sm font-medium truncate">{{ auth()->user()->name }}</p>
                    <p class="text-slate-500 text-[11px] truncate">Administrator</p>
                </div>
                <svg class="w-4 h-4 text-slate-500 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                class="mt-1 bg-[#1e293b] rounded-xl overflow-hidden border border-white/[0.07]">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-red-400 hover:bg-red-500/10 hover:text-red-300 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- ======== MAIN ======== --}}
    <div class="lg:pl-[260px] flex flex-col min-h-full">

        {{-- TOPBAR --}}
        <header class="sticky top-0 z-10 h-16 bg-white/80 backdrop-blur-md border-b border-slate-200/80 flex items-center px-4 sm:px-6 gap-4 shadow-sm">

            {{-- Hamburger --}}
            <button @click="sidebarOpen = !sidebarOpen"
                class="lg:hidden p-2 rounded-lg text-slate-500 hover:bg-slate-100 transition shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            {{-- Breadcrumb / Title --}}
            <div class="flex-1 min-w-0">
                <h1 class="text-[15px] font-semibold text-slate-800 truncate">@yield('page-title', 'Dashboard')</h1>
                <p class="text-[11px] text-slate-400 hidden sm:block">SD Negeri Warialau &mdash; Panel Administrasi</p>
            </div>

            {{-- Right actions --}}
            <div class="flex items-center gap-2 shrink-0">
                {{-- Date badge --}}
                <span class="hidden md:inline-flex items-center gap-1.5 text-xs text-slate-500 bg-slate-100 px-3 py-1.5 rounded-lg">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    {{ now()->translatedFormat('d M Y') }}
                </span>

                {{-- Avatar --}}
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>
        </header>

        {{-- PAGE CONTENT --}}
        <main class="flex-1 p-4 sm:p-6 lg:p-7">

            {{-- Toast notifications --}}
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-cloak
                    x-init="setTimeout(() => show = false, 4000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-end="opacity-0 translate-y-2"
                    class="fixed bottom-6 right-6 z-50 flex items-center gap-3 bg-white border border-green-100 text-slate-800 px-4 py-3.5 rounded-2xl shadow-xl shadow-green-100/50 max-w-sm">
                    <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium">{{ session('success') }}</span>
                    <button @click="show = false" class="ml-auto text-slate-300 hover:text-slate-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-cloak
                    x-init="setTimeout(() => show = false, 5000)"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="fixed bottom-6 right-6 z-50 flex items-center gap-3 bg-white border border-red-100 text-slate-800 px-4 py-3.5 rounded-2xl shadow-xl shadow-red-100/50 max-w-sm">
                    <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <span class="text-sm font-medium">{{ session('error') }}</span>
                    <button @click="show = false" class="ml-auto text-slate-300 hover:text-slate-500 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            @endif

            @yield('content')
        </main>

        <footer class="text-center text-xs text-slate-400 py-4 border-t border-slate-200/60 bg-white/50">
            &copy; {{ date('Y') }} SD Negeri Warialau &mdash; Sistem Informasi Sekolah
        </footer>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function adminLayout() {
            return { sidebarOpen: false }
        }
    </script>
    @stack('scripts')
</body>
</html>
