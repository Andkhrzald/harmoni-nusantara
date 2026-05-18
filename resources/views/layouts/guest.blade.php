<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>
            @hasSection('title')
                @yield('title'){{ $__pageTitleSeparator }}{{ $__pageTitleDefault }}
            @else
                {{ $__pageTitleDefault }}
            @endif
        </title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

        <style>
            .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }

            /* Batik-inspired pattern */
            .batik-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }

            /* Warm gradient overlay */
            .warm-overlay {
                background: linear-gradient(135deg, rgba(180, 83, 9, 0.9) 0%, rgba(146, 64, 14, 0.95) 100%);
            }

            .float-animation {
                animation: float 6s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }

            .pulse-ring {
                animation: pulse-ring 2s cubic-bezier(0.455, 0.03, 0.515, 0.955) infinite;
            }

            @keyframes pulse-ring {
                0% { transform: scale(0.8); opacity: 1; }
                100% { transform: scale(1.3); opacity: 0; }
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans">
        <div class="min-h-screen flex">
            <!-- Left Side - Decorative Panel -->
            <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden">
                <!-- Background gradient -->
                <div class="absolute inset-0 warm-overlay"></div>

                <!-- Batik pattern overlay -->
                <div class="absolute inset-0 batik-pattern"></div>

                <!-- Content -->
                <div class="relative z-10 flex flex-col items-center justify-center w-full px-12 py-16 text-center">
                    <!-- Logo with glow effect -->
                    <div class="mb-8 relative">
                        <div class="absolute inset-0 bg-white/20 rounded-full blur-2xl"></div>
                        <div class="relative float-animation">
                            <span class="material-symbols-outlined text-8xl text-white/90">auto_awesome</span>
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-white mb-4 tracking-tight">
                        Harmoni<span class="text-amber-300">Nusantara</span>
                    </h1>

                    <!-- Tagline -->
                    <p class="text-lg text-white/80 max-w-md mb-12">
                        Membangun jembatan antar umat beragam untuk Indonesia yang lebih harmonis dan toleran
                    </p>

                    <!-- Values / Symbols -->
                    <div class="flex items-center justify-center gap-8">
                        <div class="flex flex-col items-center">
                            <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur flex items-center justify-center mb-2 border border-white/20">
                                <span class="material-symbols-outlined text-2xl text-amber-300">diversity_3</span>
                            </div>
                            <span class="text-xs text-white/70">Beragaman</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur flex items-center justify-center mb-2 border border-white/20">
                                <span class="material-symbols-outlined text-2xl text-green-400">handshake</span>
                            </div>
                            <span class="text-xs text-white/70">Toleransi</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <div class="w-14 h-14 rounded-2xl bg-white/10 backdrop-blur flex items-center justify-center mb-2 border border-white/20">
                                <span class="material-symbols-outlined text-2xl text-blue-300">favorite</span>
                            </div>
                            <span class="text-xs text-white/70">Harmoni</span>
                        </div>
                    </div>
                </div>

                <!-- Decorative circles -->
                <div class="absolute top-20 left-20 w-32 h-32 bg-white/5 rounded-full blur-3xl"></div>
                <div class="absolute bottom-20 right-20 w-48 h-48 bg-amber-500/10 rounded-full blur-3xl"></div>
                <div class="absolute top-1/2 right-10 w-24 h-24 bg-green-500/10 rounded-full blur-2xl"></div>
            </div>

            <!-- Right Side - Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-gradient-to-br from-surface-light to-white">
                <div class="w-full max-w-md">
                    <!-- Mobile Logo -->
                    <div class="lg:hidden flex items-center justify-center mb-8 gap-3">
                        <span class="material-symbols-outlined text-4xl text-primary">auto_awesome</span>
                        <span class="text-2xl font-bold text-gray-800">Harmoni<span class="text-primary-700">Nusantara</span></span>
                    </div>

                    <!-- Form Container -->
                    <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8">
                        {{ $slot }}
                    </div>

                    <!-- Footer -->
                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-500">
                            &copy; {{ date('Y') }} Harmoni Nusantara. Semua hak dilindungi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>