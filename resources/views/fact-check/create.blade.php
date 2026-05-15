<x-app-layout>
    @section('title', 'Submit Cek Fakta')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Submit Cek Fakta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('aksi.fakta.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Judul Klaim</label>
                    <input type="text" name="title" class="mt-1 block w-full border rounded-lg px-4 py-2" required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Penjelasan</label>
                    <textarea name="content" rows="4" class="mt-1 block w-full border rounded-lg px-4 py-2" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Verdict</label>
                    <select name="verdict" class="mt-1 block w-full border rounded-lg px-4 py-2">
                        <option value="hoax">Hoax / Palsu</option>
                        <option value="true">Benar</option>
                        <option value="misleading">Menyesatkan</option>
                        <option value="unverified">Belum Terverifikasi</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Link Sumber (Opsional)</label>
                    <input type="url" name="source_link" class="mt-1 block w-full border rounded-lg px-4 py-2">
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700">
                    Publish
                </button>
            </form>
        </div>
    </div>
</x-app-layout>