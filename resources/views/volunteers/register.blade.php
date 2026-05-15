<x-app-layout>
    @section('title', 'Daftar Jadi Relawan')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Jadi Relawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('aksi.relawan.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Program Relawan</label>
                    <input type="text" name="program_name" class="mt-1 block w-full border rounded-lg px-4 py-2" placeholder="Contoh: Edukasi Toleransi" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lingkup Agama</label>
                    <select name="religion_scope" class="mt-1 block w-full border rounded-lg px-4 py-2">
                        <option value="all">Semua Agama</option>
                        <option value="islam">Islam</option>
                        <option value="kristen">Kristen</option>
                        <option value="katolik">Katolik</option>
                        <option value="hindu">Hindu</option>
                        <option value="buddha">Buddha</option>
                        <option value="konghucu">Konghucu</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Lokasi</label>
                    <input type="text" name="location" class="mt-1 block w-full border rounded-lg px-4 py-2" placeholder="Contoh: Jakarta">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Motivasi</label>
                    <textarea name="motivation" rows="4" class="mt-1 block w-full border rounded-lg px-4 py-2" placeholder="Ceritakan mengapa Anda ingin menjadi relator..."></textarea>
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700">
                    Daftar Sekarang
                </button>
            </form>
        </div>
    </div>
</x-app-layout>