<x-guest-layout>
    @section('title', 'Masuk')

    <!-- Header -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-primary to-primary-700 mb-4 shadow-lg shadow-primary/30">
            <span class="material-symbols-outlined text-3xl text-white">login</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang Kembali</h2>
        <p class="text-gray-500 mt-2">Masuk ke akun Harmoni Nusantara Anda</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="mb-2 font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">mail</span>
                </div>
                <x-text-input id="email"
                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-primary focus:ring-0 transition-all duration-200"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="email@contoh.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-2">
                <x-input-label for="password" :value="__('Password')" class="font-medium" />
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:text-primary-700 font-medium">
                        Lupa password?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">lock</span>
                </div>
                <x-text-input id="password"
                    class="block w-full pl-12 pr-12 py-3.5 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-primary focus:ring-0 transition-all duration-200"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••" />
                <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <span id="toggle-icon" class="material-symbols-outlined text-gray-400 hover:text-gray-600">visibility</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary/50" name="remember">
                <span class="ml-3 text-sm text-gray-600">Ingat saya</span>
            </label>
        </div>

        <!-- Submit Button -->
        <x-primary-button class="w-full justify-center py-3.5 text-base font-semibold rounded-xl shadow-lg shadow-primary/25 bg-gradient-to-r from-primary to-primary-700 hover:from-primary-600 hover:to-primary-800 focus:ring-4 focus:ring-primary/30 transition-all duration-200">
            <span class="material-symbols-outlined mr-2">door_open</span>
            {{ __('Masuk') }}
        </x-primary-button>
    </form>

    <!-- Divider -->
    <div class="relative my-8">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-white text-gray-400">atau</span>
        </div>
    </div>

    <!-- Register Link -->
    <div class="text-center">
        <p class="text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-primary font-semibold hover:text-primary-700 underline underline-offset-4">
                Daftar sekarang
            </a>
        </p>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggle-icon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = 'visibility';
            }
        }
    </script>
</x-guest-layout>