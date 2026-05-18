<x-guest-layout>
    @section('title', 'Daftar')

    <!-- Header -->
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-green-500 to-green-600 mb-4 shadow-lg shadow-green-500/30">
            <span class="material-symbols-outlined text-3xl text-white">person_add</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h2>
        <p class="text-gray-500 mt-2">Gabung dengan komunitas Harmoni Nusantara</p>
    </div>

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <!-- Avatar Upload -->
        <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 hover:border-primary/50 transition-colors">
            <div class="relative shrink-0" id="avatar-preview">
                <span class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-xl font-bold text-primary border-2 border-primary/20">
                    <span class="material-symbols-outlined">photo_camera</span>
                </span>
            </div>
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-700">Foto Profil (Opsional)</p>
                <p class="text-xs text-gray-400 mb-2">JPG, PNG atau WebP max 2MB</p>
                <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                    class="block w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary hover:file:bg-primary-100 transition-colors cursor-pointer"
                    onchange="previewAvatar(this)" />
                <x-input-error class="mt-1" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <script>
            function previewAvatar(input) {
                const preview = document.getElementById('avatar-preview');
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" class="w-16 h-16 rounded-full object-cover border-2 border-primary/30 shadow-md">`;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="mb-2 font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">person</span>
                </div>
                <x-text-input id="name"
                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-primary focus:ring-0 transition-all duration-200"
                    type="text"
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    placeholder="Nama lengkap Anda" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
                    autocomplete="username"
                    placeholder="email@contoh.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Religion Preference -->
        <div>
            <x-input-label for="religion_preference" :value="__('Agama (Opsional)')" class="mb-2 font-medium" />
            <div class="relative">
                <select id="religion_preference" name="religion_preference"
                    class="block w-full pl-4 pr-10 py-3.5 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-primary focus:ring-0 transition-all duration-200 appearance-none cursor-pointer">
                    <option value="">-- Pilih Agama --</option>
                    <option value="islam" {{ old('religion_preference') == 'islam' ? 'selected' : '' }}>Islam</option>
                    <option value="kristen" {{ old('religion_preference') == 'kristen' ? 'selected' : '' }}>Kristen Protestan</option>
                    <option value="katolik" {{ old('religion_preference') == 'katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="hindu" {{ old('religion_preference') == 'hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="buddha" {{ old('religion_preference') == 'buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="konghucu" {{ old('religion_preference') == 'konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
                <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">expand_more</span>
                </div>
            </div>
            <x-input-error :messages="$errors->get('religion_preference')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="mb-2 font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">lock</span>
                </div>
                <x-text-input id="password"
                    class="block w-full pl-12 pr-12 py-3.5 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-primary focus:ring-0 transition-all duration-200"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••" />
                <button type="button" onclick="toggleRegisterPassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <span id="register-toggle-icon" class="material-symbols-outlined text-gray-400 hover:text-gray-600">visibility</span>
                </button>
            </div>
            <p class="mt-1 text-xs text-gray-400">Minimal 8 karakter</p>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="mb-2 font-medium" />
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <span class="material-symbols-outlined text-gray-400">lock</span>
                </div>
                <x-text-input id="password_confirmation"
                    class="block w-full pl-12 pr-4 py-3.5 bg-gray-50 border-2 border-transparent rounded-xl focus:bg-white focus:border-primary focus:ring-0 transition-all duration-200"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <x-primary-button class="w-full justify-center py-3.5 mt-6 text-base font-semibold rounded-xl shadow-lg shadow-green-500/25 bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 focus:ring-4 focus:ring-green-500/30 transition-all duration-200">
            <span class="material-symbols-outlined mr-2">how_to_reg</span>
            {{ __('Daftar Sekarang') }}
        </x-primary-button>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-200"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-4 bg-white text-gray-400">atau</span>
        </div>
    </div>

    <!-- Login Link -->
    <div class="text-center">
        <p class="text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-primary font-semibold hover:text-primary-700 underline underline-offset-4">
                Masuk di sini
            </a>
        </p>
    </div>

    <script>
        function toggleRegisterPassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('register-toggle-icon');
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