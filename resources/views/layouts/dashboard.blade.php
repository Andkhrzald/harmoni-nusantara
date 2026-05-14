<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
            @yield('title') — {{ config('app.name') }}
        @else
            {{ config('app.name') }}
        @endif
    </title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

    <style>
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        [x-cloak] { display: none !important; }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased">
    @php
        $user = Auth::user();
        $initials = strtoupper(implode('', array_map(fn($w) => $w[0], explode(' ', $user->name))));
        $currentRoute = request()->route()?->getName();

        $navItems = [
            ['route' => 'dashboard', 'label' => 'Dashboard', 'icon' => 'dashboard'],
            ['route' => 'dashboard.donations', 'label' => 'Donasi', 'icon' => 'volunteer_activism'],
            ['route' => 'dashboard.learning', 'label' => 'Belajar', 'icon' => 'menu_book'],
            ['route' => 'dashboard.consultations', 'label' => 'Konsultasi', 'icon' => 'forum'],
        ];

        $ibadahActive = request()->routeIs('ibadah.*');

        $ibadahItems = [
            ['route' => 'ibadah.schedule', 'label' => 'Jadwal Ibadah', 'icon' => 'calendar_month'],
            ['route' => 'ibadah.map', 'label' => 'Peta Rumah Ibadah', 'icon' => 'map'],
            ['route' => 'ibadah.guide', 'label' => 'Panduan Ritual', 'icon' => 'self_improvement'],
            ['route' => 'ibadah.etiquette', 'label' => 'Etiket Bertamu', 'icon' => 'handshake'],
        ];

        if ($user->role === 'admin' || $user->role === 'penyuluh') {
            $navItems[] = ['route' => 'aksi.cek-fakta.index', 'label' => 'Cek Fakta', 'icon' => 'fact_check'];
        }

        $navItems[] = ['route' => 'profile.edit', 'label' => 'Profil', 'icon' => 'person'];
    @endphp

    <div class="min-h-screen bg-gray-50 flex" x-data="{ sidebarOpen: false }">

        {{-- Mobile backdrop --}}
        <div x-show="sidebarOpen"
             x-cloak
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-30 bg-black/30 lg:hidden"
             @click="sidebarOpen = false">
        </div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:z-auto flex flex-col h-screen">

            {{-- Logo --}}
            <div class="h-16 flex items-center gap-2 px-6 border-b border-gray-100 shrink-0">
                <span class="w-8 h-8 rounded-lg bg-gradient-to-br from-primary-700 to-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-sm">public</span>
                </span>
                <span class="text-lg font-bold text-gray-800 tracking-tight">Harmony</span>
            </div>

            {{-- Nav Items --}}
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
                <p class="px-3 mb-2 text-xs font-semibold text-gray-400 uppercase tracking-wider">Menu</p>

                @foreach ($navItems as $item)
                    @php
                        $active = request()->routeIs($item['route']);
                    @endphp
                    <a href="{{ route($item['route']) }}"
                       @class([
                           'flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition-all group',
                           'bg-primary-50 text-primary shadow-sm' => $active,
                           'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !$active,
                       ])>
                        <span @class([
                            'material-symbols-outlined text-lg transition-all',
                            'text-primary' => $active,
                            'text-gray-400 group-hover:text-gray-600' => !$active,
                        ])>{{ $item['icon'] }}</span>
                        {{ $item['label'] }}
                        @if ($active)
                            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-primary"></span>
                        @endif
                    </a>
                @endforeach

                {{-- Ibadah group (expandable) --}}
                <div x-data="{ open: @js($ibadahActive) }" class="space-y-0.5">
                    <button @click="open = !open"
                            @class([
                                'flex items-center gap-3 w-full px-3 py-2.5 rounded-xl text-sm font-medium transition-all group',
                                'bg-primary-50 text-primary shadow-sm' => $ibadahActive,
                                'text-gray-600 hover:bg-gray-50 hover:text-gray-900' => !$ibadahActive,
                            ])>
                        <span @class([
                            'material-symbols-outlined text-lg transition-all',
                            'text-primary' => $ibadahActive,
                            'text-gray-400 group-hover:text-gray-600' => !$ibadahActive,
                        ])>self_improvement</span>
                        <span class="flex-1 text-left">Ibadah</span>
                        <span class="material-symbols-outlined text-base transition-transform duration-200"
                              :class="{ 'rotate-90': open }">chevron_right</span>
                    </button>

                    <div x-show="open"
                         x-cloak
                         x-transition:enter="transition-all ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition-all ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-1"
                         class="ml-3 space-y-0.5 border-l-2 border-primary-100 pl-2">
                        @foreach ($ibadahItems as $item)
                            @php $subActive = request()->routeIs($item['route']); @endphp
                            <a href="{{ route($item['route']) }}"
                               @class([
                                   'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all',
                                   'bg-primary-50 text-primary' => $subActive,
                                   'text-gray-500 hover:bg-gray-50 hover:text-gray-700' => !$subActive,
                               ])>
                                <span class="material-symbols-outlined text-base text-gray-400">{{ $item['icon'] }}</span>
                                {{ $item['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </nav>

            {{-- Bottom: User & Logout --}}
            <div class="p-4 border-t border-gray-100 shrink-0">
                <div class="flex items-center gap-3 px-3 py-2 mb-2">
                    <span class="w-9 h-9 rounded-full bg-primary-100 text-primary flex items-center justify-center text-sm font-semibold shrink-0">
                        {{ $initials }}
                    </span>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-gray-800 truncate">{{ $user->name }}</p>
                        <p class="text-xs text-gray-400 truncate capitalize">{{ $user->role }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-3 py-2.5 text-sm text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                        <span class="material-symbols-outlined text-lg">logout</span>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Area --}}
        <div class="flex-1 flex flex-col min-w-0 min-h-screen">

            {{-- Topbar --}}
            <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 lg:px-6 shrink-0">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 text-gray-500 hover:text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                    <span class="material-symbols-outlined">menu</span>
                </button>

                <div class="hidden lg:flex items-center gap-2 text-sm text-gray-400">
                    <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Beranda</a>
                    <span class="material-symbols-outlined text-base">chevron_right</span>
                    <span class="text-gray-600">@yield('title', 'Dashboard')</span>
                </div>

                <div class="flex items-center gap-2 ml-auto">
                    <a href="{{ route('home') }}"
                       class="hidden sm:inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-primary px-3 py-1.5 rounded-lg hover:bg-gray-50 transition-colors">
                        <span class="material-symbols-outlined text-base">arrow_back</span>
                        Ke Situs
                    </a>
                    <span class="w-8 h-8 rounded-full bg-primary-100 text-primary flex items-center justify-center text-sm font-semibold">
                        {{ $initials }}
                    </span>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-4 lg:p-8 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
</body>
</html>
