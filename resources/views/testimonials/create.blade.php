<x-app-layout>
    @section('title', 'Bagikan Kisah')
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">rate_review</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Bagikan Kisah Anda</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-50 p-8">
                <div class="text-center mb-8">
                    <span class="material-symbols-outlined text-5xl text-secondary mb-3">edit_note</span>
                    <h3 class="text-xl font-bold text-primary mb-2">Ceritakan Pengalaman Anda</h3>
                    <p class="text-gray-500 text-sm">Bagaimana Harmoni Nusantara membawa dampak positif dalam hidup Anda?</p>
                </div>

                <form action="{{ route('testimoni.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                        @if (Auth::user()->avatar)
                            <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                                 class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-sm">
                        @else
                            <span class="w-14 h-14 rounded-full bg-primary/10 flex items-center justify-center text-xl font-bold text-primary border-2 border-white shadow-sm">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400">Nama akan otomatis terisi dari akun Anda</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Judul / Peran <span class="text-gray-400 text-xs">(opsional)</span>
                        </label>
                        <input type="text" name="title" value="{{ old('title') }}" maxlength="255"
                               class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all @error('title') border-red-300 @enderror"
                               placeholder="Contoh: Penerima Beasiswa Jakarta 2025">
                        @error('title') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        <p class="text-xs text-gray-400 mt-1">Misalnya: Penerima Beasiswa, Peserta Program Relawan, Pengguna Aktif Forum, dll.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Cerita Anda <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" rows="6" required minlength="10"
                                  class="w-full border border-gray-300 rounded-xl px-4 py-2.5 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all resize-none @error('content') border-red-300 @enderror"
                                  placeholder="Ceritakan bagaimana Harmoni Nusantara membantu Anda...">{{ old('content') }}</textarea>
                        @error('content') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit"
                                class="bg-secondary text-white px-8 py-3 rounded-xl font-semibold hover:opacity-90 transition-all shadow-md hover:shadow-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">send</span>
                            Kirim Kisah
                        </button>
                        <a href="{{ url()->previous() }}"
                           class="text-gray-500 hover:text-gray-700 font-medium text-sm px-4 py-3 rounded-xl hover:bg-gray-50 transition-all">
                            Batal
                        </a>
                    </div>

                    <div class="flex items-center gap-2 text-xs text-gray-400 pt-4 border-t border-gray-100">
                        <span class="material-symbols-outlined text-sm">info</span>
                        <span>Kisah Anda akan ditampilkan setelah diverifikasi oleh admin.</span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
