<x-app-layout>
    @section('title', 'Konsultasi Baru')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konsultasi Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <p class="text-gray-600 mb-6">
                    Ajukan pertanyaan atau konsultasi kepada penyuluh agama terverifikasi.
                    Semua percakapan akan dienkripsi untuk menjaga privasi Anda.
                </p>

                <form action="{{ route('aksi.consultations.store') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Topik Konsultasi</label>
                        <input type="text" name="title" class="w-full border rounded-lg px-4 py-2" placeholder="Contoh: Memahami perbedaan tradisi keagamaan" required>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700">
                        Mulai Konsultasi
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>