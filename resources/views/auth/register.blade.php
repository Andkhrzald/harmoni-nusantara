<x-guest-layout>
    @section('title', 'Daftar')
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        <div class="text-center mb-6">
            <div class="w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center mx-auto mb-2">
                <span class="material-symbols-outlined text-3xl text-primary">person_add</span>
            </div>
            <h2 class="text-xl font-bold text-gray-800">Daftar Akun Baru</h2>
            <p class="text-sm text-gray-500 mt-1">Gabung komunitas Harmoni Nusantara</p>
        </div>

        <div class="flex items-center gap-4 mb-4">
            <div class="relative shrink-0" id="avatar-preview">
                <span class="w-16 h-16 rounded-full bg-primary/10 flex items-center justify-center text-xl font-bold text-primary border-2 border-dashed border-gray-300">
                    <span class="material-symbols-outlined">photo_camera</span>
                </span>
            </div>
            <div class="flex-1">
                <x-input-label for="avatar" :value="__('Profile Photo (Optional)')" />
                <input id="avatar" name="avatar" type="file" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                       class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary hover:file:bg-primary-100 transition-colors cursor-pointer"
                       onchange="previewAvatar(this)" />
                <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
            </div>
        </div>

        <script>
            function previewAvatar(input) {
                const preview = document.getElementById('avatar-preview');
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.innerHTML = `<img src="${e.target.result}" class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">`;
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Religion Preference (Optional) -->
        <div class="mt-4">
            <x-input-label for="religion_preference" :value="__('Religion Preference (Optional)')" />
            <select id="religion_preference" name="religion_preference" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">-- Select Religion --</option>
                <option value="islam" {{ old('religion_preference') == 'islam' ? 'selected' : '' }}>Islam</option>
                <option value="kristen" {{ old('religion_preference') == 'kristen' ? 'selected' : '' }}>Kristen Protestan</option>
                <option value="katolik" {{ old('religion_preference') == 'katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="hindu" {{ old('religion_preference') == 'hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="buddha" {{ old('religion_preference') == 'buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="konghucu" {{ old('religion_preference') == 'konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
            <x-input-error :messages="$errors->get('religion_preference')" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
