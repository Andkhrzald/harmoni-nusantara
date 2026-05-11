<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Campaign Donasi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('aksi.donasi.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Campaign</label>
                    <input type="text" name="title" class="mt-1 block w-full border rounded-lg px-4 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" rows="4" class="mt-1 block w-full border rounded-lg px-4 py-2" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Target Dana (Rp)</label>
                    <input type="number" name="target_amount" class="mt-1 block w-full border rounded-lg px-4 py-2" required>
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
                    <label class="block text-sm font-medium text-gray-700">Batas Waktu (Opsional)</label>
                    <input type="date" name="deadline" class="mt-1 block w-full border rounded-lg px-4 py-2">
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700">
                    Buat Campaign
                </button>
            </form>
        </div>
    </div>
</x-app-layout>