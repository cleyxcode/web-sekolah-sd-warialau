<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SD Negeri Warialau')</title>
    <meta name="description" content="@yield('description', 'Website resmi SD Negeri Warialau - Warialau, Maluku')">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    {{-- ===== NAVBAR ===== --}}
    <header x-data="{ open: false, scrolled: false }"
            x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 10)"
            :class="scrolled ? 'shadow-md bg-white' : 'bg-white'"
            class="sticky top-0 z-50 transition-shadow duration-300">

        {{-- Top bar kuning --}}
        <div class="bg-[#FFC107] py-1.5 px-4 text-center text-xs font-medium text-[#1E3A5F]">
            Selamat datang di website resmi SD Negeri Warialau &mdash; Warialau, Maluku
        </div>

        {{-- Main navbar --}}
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="{{ route('web.beranda') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#1E3A5F] flex items-center justify-center shrink-0">
                        <span class="text-white font-bold text-sm">SD</span>
                    </div>
                    <div class="hidden sm:block">
                        <p class="font-bold text-[#1E3A5F] text-sm leading-tight">SD Negeri Warialau</p>
                        <p class="text-xs text-gray-500">Warialau, Maluku</p>
                    </div>
                </a>

                {{-- Desktop menu --}}
                <div class="hidden md:flex items-center gap-1">
                    @php
                        $navLinks = [
                            ['route' => 'web.beranda',          'label' => 'Beranda'],
                            ['route' => 'web.profil',           'label' => 'Profil'],
                            ['route' => 'web.guru',             'label' => 'Guru'],
                            ['route' => 'web.berita.index',     'label' => 'Berita'],
                            ['route' => 'web.galeri',           'label' => 'Galeri'],
                            ['route' => 'web.info-pendaftaran', 'label' => 'Pendaftaran'],
                        ];
                    @endphp

                    @foreach ($navLinks as $nav)
                        <a href="{{ route($nav['route']) }}"
                           class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-150
                                  {{ request()->routeIs($nav['route']) || (str_starts_with($nav['route'], 'web.berita') && request()->routeIs('web.berita.*'))
                                     ? 'text-[#1E3A5F] bg-[#FFC107]/20 font-semibold'
                                     : 'text-gray-600 hover:text-[#1E3A5F] hover:bg-gray-100' }}">
                            {{ $nav['label'] }}
                        </a>
                    @endforeach
                </div>

                {{-- Auth button --}}
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        @if(auth()->user()->role === 'orangtua')
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open"
                                        class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-[#1E3A5F] hover:bg-gray-100 transition">
                                    <div class="w-7 h-7 rounded-full bg-[#1E3A5F] flex items-center justify-center text-white text-xs font-bold">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <span class="max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div x-show="open" x-cloak @click.outside="open = false"
                                     x-transition:enter="transition ease-out duration-100"
                                     x-transition:enter-start="opacity-0 scale-95"
                                     x-transition:enter-end="opacity-100 scale-100"
                                     class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-50">
                                    <a href="{{ route('web.pendaftaran.status') }}"
                                       class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Status Pendaftaran
                                    </a>
                                    <div class="border-t border-gray-100 my-1"></div>
                                    <form method="POST" action="{{ route('web.auth.logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @else
                        <a href="{{ route('web.auth.login') }}"
                           class="px-4 py-2 text-sm font-semibold text-[#1E3A5F] border border-[#1E3A5F] rounded-lg hover:bg-[#1E3A5F] hover:text-white transition-colors duration-150">
                            Login Orang Tua
                        </a>
                        <a href="{{ route('web.pendaftaran.form') }}"
                           class="px-4 py-2 text-sm font-semibold bg-[#FFC107] text-[#1E3A5F] rounded-lg hover:bg-[#e6ac00] transition-colors duration-150">
                            Daftar Sekarang
                        </a>
                    @endauth
                </div>

                {{-- Hamburger --}}
                <button @click="open = !open"
                        class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition">
                    <svg x-show="!open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="open" x-cloak class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile menu --}}
            <div x-show="open" x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-2"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="md:hidden pb-4 border-t border-gray-100 mt-1">
                <div class="pt-3 space-y-1">
                    @foreach ($navLinks as $nav)
                        <a href="{{ route($nav['route']) }}"
                           class="block px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                                  {{ request()->routeIs($nav['route']) || (str_starts_with($nav['route'], 'web.berita') && request()->routeIs('web.berita.*'))
                                     ? 'text-[#1E3A5F] bg-[#FFC107]/20 font-semibold'
                                     : 'text-gray-600 hover:text-[#1E3A5F] hover:bg-gray-50' }}">
                            {{ $nav['label'] }}
                        </a>
                    @endforeach
                    <div class="pt-3 flex flex-col gap-2 border-t border-gray-100 mt-2">
                        @auth
                            @if(auth()->user()->role === 'orangtua')
                                <a href="{{ route('web.pendaftaran.status') }}" class="block px-3 py-2.5 text-sm font-medium text-gray-700">
                                    Status Pendaftaran ({{ auth()->user()->name }})
                                </a>
                                <form method="POST" action="{{ route('web.auth.logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-3 py-2.5 text-sm font-medium text-red-600">
                                        Keluar
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('web.auth.login') }}"
                               class="block px-3 py-2.5 text-center text-sm font-semibold text-[#1E3A5F] border border-[#1E3A5F] rounded-lg">
                                Login Orang Tua
                            </a>
                            <a href="{{ route('web.pendaftaran.form') }}"
                               class="block px-3 py-2.5 text-center text-sm font-semibold bg-[#FFC107] text-[#1E3A5F] rounded-lg">
                                Daftar Sekarang
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    {{-- Flash --}}
    @if (session('success') || session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)"
         x-show="show" x-cloak x-transition
         class="fixed top-20 right-4 z-50 max-w-sm">
        @if(session('success'))
        <div class="bg-green-600 text-white text-sm px-5 py-3 rounded-xl shadow-lg flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="bg-red-600 text-white text-sm px-5 py-3 rounded-xl shadow-lg flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
        @endif
    </div>
    @endif

    {{-- ===== MAIN CONTENT ===== --}}
    <main>
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-[#1E3A5F] text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Info Sekolah --}}
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-[#FFC107] flex items-center justify-center shrink-0">
                            <span class="text-[#1E3A5F] font-bold text-sm">SD</span>
                        </div>
                        <div>
                            <p class="font-bold text-white text-sm">SD Negeri Warialau</p>
                            <p class="text-xs text-blue-200">Warialau, Maluku</p>
                        </div>
                    </div>
                    <p class="text-sm text-blue-200 leading-relaxed">
                        Sekolah dasar yang unggul, berkarakter, dan berwawasan lingkungan.
                    </p>
                </div>

                {{-- Navigasi --}}
                <div>
                    <h4 class="text-sm font-semibold text-[#FFC107] mb-4 uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-2">
                        @foreach([
                            ['route' => 'web.beranda',          'label' => 'Beranda'],
                            ['route' => 'web.profil',           'label' => 'Profil Sekolah'],
                            ['route' => 'web.guru',             'label' => 'Data Guru'],
                            ['route' => 'web.berita.index',     'label' => 'Berita & Pengumuman'],
                            ['route' => 'web.galeri',           'label' => 'Galeri Foto'],
                            ['route' => 'web.info-pendaftaran', 'label' => 'Info Pendaftaran'],
                        ] as $nav)
                        <li>
                            <a href="{{ route($nav['route']) }}" class="text-sm text-blue-200 hover:text-[#FFC107] transition-colors">
                                {{ $nav['label'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <h4 class="text-sm font-semibold text-[#FFC107] mb-4 uppercase tracking-wider">Kontak</h4>
                    <ul class="space-y-3 text-sm text-blue-200">
                        <li class="flex items-start gap-2">
                            <svg class="w-4 h-4 mt-0.5 shrink-0 text-[#FFC107]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Warialau, Maluku, Indonesia
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-blue-800 mt-10 pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-blue-300">&copy; {{ date('Y') }} SD Negeri Warialau. Hak cipta dilindungi.</p>
                <p class="text-xs text-blue-400">Dibuat untuk keperluan skripsi &mdash; UKIM Ambon 2026</p>
            </div>
        </div>
    </footer>

</body>
</html>
