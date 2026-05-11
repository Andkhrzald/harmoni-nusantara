<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Etiket Bertamu ke Rumah Ibadah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex gap-4 flex-wrap">
                @foreach(['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu'] as $religion)
                <a href="{{ route('ibadah.etiquette', $religion) }}"
                   class="px-4 py-2 rounded-lg {{ $religion === request('religion') ? 'bg-indigo-600 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">
                    {{ ucfirst($religion) }}
                </a>
                @endforeach
            </div>

            <div class="bg-white shadow-sm rounded-lg p-6">
                @if($religion === 'islam')
                <h3 class="text-xl font-semibold mb-4">Etiket ke Masjid</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Melepas sepatu sebelum memasuki ruangan utama</li>
                    <li>Menggunakan pakaian yang sopan dan menutup aurat</li>
                    <li>Berbicara dengan suara pelan</li>
                    <li>Tidak berfoto tanpa izin</li>
                    <li>Menghormati waktu salat</li>
                </ul>
                @elseif(in_array($religion, ['kristen', 'katolik']))
                <h3 class="text-xl font-semibold mb-4">Etiket ke Gereja</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Pakaian yang sopan dan rapi</li>
                    <li>Tepat waktu mengikuti ibadah</li>
                    <li>Menjaga ketenangan selama Misa</li>
                    <li>Tidak menggunakan telef Seluler</li>
                    <li>Mematuhi protokol gereja</li>
                </ul>
                @elseif($religion === 'hindu')
                <h3 class="text-xl font-semibold mb-4">Etiket ke Pura</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Melepas sepatu dan menutup kaki</li>
                    <li>Mengenakan sarung atau kain khusus (disediakan di pura)</li>
                    <li>Membawa sesajen (bunga, buah, atau incense)</li>
                    <li>Tidak berfoto pada saat puja berlangsung</li>
                    <li>Duduk dengan kaki terlipat atau bersimpuh</li>
                </ul>
                @elseif($religion === 'buddha')
                <h3 class="text-xl font-semibold mb-4">Etiket ke Vihara</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Melepas sepatu sebelum memasuki</li>
                    <li>Pakaian yang sopan dan tidak ketat</li>
                    <li>Melakukan sembah sujud kepada Patung Buddha</li>
                    <li>Berbicara dengan suara pelan</li>
                    <li>Menghormati para bhikkhu</li>
                </ul>
                @else
                <h3 class="text-xl font-semibold mb-4">Etiket ke Klenteng</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Melepas sepatu sebelum memasuki</li>
                    <li>Pakaian yang sopan</li>
                    <li>Membakar incense sebagai tanda penghormatan</li>
                    <li>Tidak mengganggu altar utama</li>
                    <li>Menghormati waktu ibadah</li>
                </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>