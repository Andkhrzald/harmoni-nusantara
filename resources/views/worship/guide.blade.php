<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panduan Ritual') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex gap-4 flex-wrap">
                @foreach(['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu'] as $religion)
                <a href="{{ route('ibadah.guide', $religion) }}"
                   class="px-4 py-2 rounded-lg {{ $religion === request('religion') ? 'bg-indigo-600 text-white' : 'bg-gray-200 hover:bg-gray-300' }}">
                    {{ ucfirst($religion) }}
                </a>
                @endforeach
            </div>

            <div class="bg-white shadow-sm rounded-lg p-6">
                @if($religion === 'islam')
                <h3 class="text-xl font-semibold mb-4">Panduan Ibadah Islam</h3>
                <div class="space-y-4">
                    <h4 class="font-medium">1. Salat 5 Waktu</h4>
                    <p class="text-gray-600">Salat wajib yang dilakukan pada waktu Subuh, Zuhur, Asar, Magrib, dan Isya.</p>
                    <h4 class="font-medium">2. Wudhu</h4>
                    <p class="text-gray-600">Membersihkan diri sebelum salat dengan air yang mengalir pada wajah, tangan, kepala, dan kaki.</p>
                    <h4 class="font-medium">3. Puasa Ramadan</h4>
                    <p class="text-gray-600">Puasa sebulan penuh dari fajar hingga Maghrib dengan menahan makan, minum, dan perilaku negatif.</p>
                </div>
                @elseif($religion === 'kristen')
                <h3 class="text-xl font-semibold mb-4">Panduan Ibadah Kristen Protestan</h3>
                <div class="space-y-4">
                    <h4 class="font-medium">1. Ibadah Minggu</h4>
                    <p class="text-gray-600">Ibadah utama setiap minggu yang terdiri dari pujian, firman, dan sakramen.</p>
                    <h4 class="font-medium">2. Doa</h4>
                    <p class="text-gray-600">Komunikasi langsung dengan Tuhan melalui doa pribadi dan bersama.</p>
                </div>
                @elseif($religion === 'katolik')
                <h3 class="text-xl font-semibold mb-4">Panduan Ibadah Katolik</h3>
                <div class="space-y-4">
                    <h4 class="font-medium">1. Misa</h4>
                    <p class="text-gray-600">Ibadah Eucharist yang peringatan mystik atas Tubuh dan Darah Kristus.</p>
                    <h4 class="font-medium">2. Sakramen</h4>
                    <p class="text-gray-600">Tujuh sakramen termasuk Baptis, Komuni, Pengakuan, dan Pengurapan.</p>
                </div>
                @elseif($religion === 'hindu')
                <h3 class="text-xl font-semibold mb-4">Panduan Ibadah Hindu</h3>
                <div class="space-y-4">
                    <h4 class="font-medium">1. Puja</h4>
                    <p class="text-gray-600">Ibadah harian dengan sesajen dan doa kepada dewa-dewa.</p>
                    <h4 class="font-medium">2. Yajna</h4>
                    <p class="text-gray-600">Ibadah api suci dengan ritual pensucian.</p>
                </div>
                @elseif($religion === 'buddha')
                <h3 class="text-xl font-semibold mb-4">Panduan Ibadah Buddha</h3>
                <div class="space-y-4">
                    <h4 class="font-medium">1. Meditation</h4>
                    <p class="text-gray-600">Praktik untuk menenangkan pikiran dan mencapai pencerahan.</p>
                    <h4 class="font-medium">2. Puja</h4>
                    <p class="text-gray-600">Ibadah dengan doa dan persembahan kepada Buddha dan Bodhisattva.</p>
                </div>
                @else
                <h3 class="text-xl font-semibold mb-4">Panduan Ibadah Konghucu</h3>
                <div class="space-y-4">
                    <h4 class="font-medium">1. Ritual Confucius</h4>
                    <p class="text-gray-600">Upacara untuk menghormati leluhur dan Confucius.</p>
                    <h4 class="font-medium">2. Doa dan Meditasi</h4>
                    <p class="text-gray-600">Praktik spiritual untuk mencapai keharmonisan.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>