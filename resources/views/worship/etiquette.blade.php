<x-app-layout>
    @section('title', 'Etiket Bertamu ' . ucfirst($religion))
    @php
    $validSlugs = ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu'];
    $current = in_array($religion, $validSlugs) ? $religion : 'islam';

    $religionMeta = [
        'islam'    => ['icon' => 'mosque',         'color' => 'emerald', 'place' => 'Masjid'],
        'kristen'  => ['icon' => 'church',         'color' => 'blue',    'place' => 'Gereja'],
        'katolik'  => ['icon' => 'church',         'color' => 'violet',  'place' => 'Gereja'],
        'hindu'    => ['icon' => 'temple_hindu',    'color' => 'orange',  'place' => 'Pura'],
        'buddha'   => ['icon' => 'temple_buddhist', 'color' => 'amber',   'place' => 'Vihara'],
        'konghucu' => ['icon' => 'temple_buddhist', 'color' => 'red',     'place' => 'Klenteng'],
    ];

    $etiquettes = [
        'islam' => [
            'desc' => 'Panduan tata krama saat mengunjungi Masjid. Hormati kesucian rumah ibadah umat Islam dengan mengikuti etiket berikut.',
            'rules' => [
                ['icon' => 'checkroom',          'title' => 'Berpakaian Sopan', 'detail' => 'Kenakan pakaian yang menutup aurat. Wanita disarankan memakai kerudung dan pakaian longgar. Pria disarankan memakai baju koko/kemeja dan celana panjang. Hindari pakaian ketat atau transparan.'],
                ['icon' => 'footwear',           'title' => 'Lepas Alas Kaki', 'detail' => 'Lepas sepatu sebelum memasuki area masjid. Simpan sepatu di rak yang disediakan. Beberapa masjid menyediakan sandal untuk ke toilet.'],
                ['icon' => 'volume_up',           'title' => 'Jaga Kesunyian', 'detail' => 'Bicara dengan suara pelan. Jangan bercanda atau tertawa keras. Matikan atau silent ponsel. Jika ingin membaca Al-Qur\'an, lakukan dengan suara pelan.'],
                ['icon' => 'no_photography',      'title' => 'Foto & Video', 'detail' => 'Mohon izin terlebih dahulu sebelum mengambil foto. Jangan memotret jamaah yang sedang salat. Hindari penggunaan flash. Beberapa masjid melarang fotografi sama sekali.'],
                ['icon' => 'schedule',            'title' => 'Hormati Waktu Salat', 'detail' => 'Jika waktu salat tiba, pengunjung non-Muslim dipersilakan menunggu di luar atau di area yang disediakan. Ikuti arahan pengurus masjid.'],
                ['icon' => 'restaurant',          'title' => 'Makan & Minum', 'detail' => 'Makan dan minum hanya di area yang disediakan. Jangan makan sambil berjalan di area salat. Buang sampah pada tempatnya.'],
                ['icon' => 'wc',                  'title' => 'Kebersihan Toilet', 'detail' => 'Toilet masjid digunakan untuk wudhu. Gunakan air secukupnya. Jangan buang tisu sembarangan. Biarkan bersih untuk jamaah berikutnya.'],
            ],
        ],
        'kristen' => [
            'desc' => 'Panduan tata krama saat mengunjungi Gereja Kristen Protestan.',
            'rules' => [
                ['icon' => 'checkroom',       'title' => 'Berpakaian Rapi', 'detail' => 'Kenakan pakaian yang sopan dan rapi. Kemeja, blus, atau pakaian formal lainnya. Hindari pakaian terlalu kasual seperti singlet atau sandal jepit.'],
                ['icon' => 'volume_up',        'title' => 'Jaga Ketenangan', 'detail' => 'Bicara dengan pelan di dalam gereja. Matikan ponsel selama ibadah. Jangan berjalan mondar-mandir saat kebaktian berlangsung.'],
                ['icon' => 'no_photography',   'title' => 'Fotografi', 'detail' => 'Tanyakan izin sebelum mengambil foto. Jangan memotret saat ibadah berlangsung tanpa izin. Beberapa sakramen seperti baptis dilarang difoto.'],
                ['icon' => 'alarm',            'title' => 'Tepat Waktu', 'detail' => 'Datang 10-15 menit sebelum ibadah dimulai. Jika terlambat, duduk di kursi paling belakang. Jangan masuk saat doa atau khotbah berlangsung.'],
                ['icon' => 'music_note',       'title' => 'Ikut Bernyanyi', 'detail' => 'Ikut bernyanyi jika Anda merasa nyaman. Berdiri saat pujian jika jemaat berdiri. Tamu tidak diwajibkan memberi persembahan.'],
            ],
        ],
        'katolik' => [
            'desc' => 'Panduan tata krama saat mengunjungi Gereja Katolik.',
            'rules' => [
                ['icon' => 'checkroom',       'title' => 'Berpakaian Sopan', 'detail' => 'Pakaian formal atau semi-formal yang sopan. Wanita disarankan menutup bahu. Pria disarankan tidak memakai topi di dalam gereja.'],
                ['icon' => 'volume_up',        'title' => 'Sikap Hening', 'detail' => 'Jaga keheningan di dalam gereja. Berbicara dengan suara berbisik. Matikan ponsel. Hening sejenak sebelum misa dimulai.'],
                ['icon' => 'sign_language',    'title' => 'Salam Damai', 'detail' => 'Salam damai dilakukan dengan jabat tangan atau anggukan. Tidak diperkenankan berkeliling untuk bersalaman. Ikuti arahan pemimpin misa.'],
                ['icon' => 'no_photography',   'title' => 'Saat Konsekrasi', 'detail' => 'Dilarang memotret saat konsekrasi (saat hosti dan anggur dikonsekrasikan). Hormati momen sakral ini dengan sikap khusyuk.'],
                ['icon' => 'wc',               'title' => 'Air Suci', 'detail' => 'Saat masuk, basuh tangan dengan air suci dan buat tanda salib. Ini adalah tradisi penghormatan. Duduk di bangku yang tersedia, tidak di altar.'],
            ],
        ],
        'hindu' => [
            'desc' => 'Panduan tata krama saat mengunjungi Pura (tempat ibadah Hindu).',
            'rules' => [
                ['icon' => 'checkroom',       'title' => 'Pakaian Khusus', 'detail' => 'Wajib mengenakan sarung/kain dan selendang. Pura biasanya menyediakan pinjaman. Wanita yang sedang datang bulan tidak diperbolehkan masuk.'],
                ['icon' => 'footwear',         'title' => 'Lepas Alas Kaki', 'detail' => 'Lepas sepatu sebelum memasuki area pura. Berjalan tanpa alas kaki di kompleks pura. Cuci kaki sebelum masuk bangunan suci.'],
                ['icon' => 'local_florist',    'title' => 'Sesajen (Banten)', 'detail' => 'Bawalah canang sari (sesajen) jika ingin sembahyang. Jika tidak, Anda bisa membeli di pedagang sekitar pura. Jangan menginjak sesajen di lantai.'],
                ['icon' => 'no_photography',   'title' => 'Saat Puja Berlangsung', 'detail' => 'Minta izin sebelum memotret. Jangan memotret saat upacara puja berlangsung. Jangan berdiri lebih tinggi dari pendeta saat ritual.'],
                ['icon' => 'self_improvement',  'title' => 'Sikap Duduk', 'detail' => 'Duduk dengan kaki terlipat atau bersimpuh. Jangan duduk bersandar di tiang atau altar. Jangan menyilangkan kaki ke arah altar.'],
                ['icon' => 'volume_up',        'title' => 'Jaga Kesucian', 'detail' => 'Bicara dengan sopan. Jangan meludah di area pura. Buang sampah pada tempatnya. Ikuti arahan pemangku (pendeta Hindu).'],
            ],
        ],
        'buddha' => [
            'desc' => 'Panduan tata krama saat mengunjungi Vihara (tempat ibadah Buddha).',
            'rules' => [
                ['icon' => 'footwear',         'title' => 'Lepas Alas Kaki', 'detail' => 'Lepas sepatu sebelum memasuki ruang utama vihara. Susun rapi di luar. Gunakan fasilitas yang disediakan.'],
                ['icon' => 'checkroom',        'title' => 'Pakaian Sopan', 'detail' => 'Kenakan pakaian yang sopan dan tidak ketat. Hindari pakaian hitam (warna duka). Tutup bahu dan lutut. Vihara biasanya menyediakan selendang.'],
                ['icon' => 'self_improvement', 'title' => 'Sujud Penghormatan', 'detail' => 'Lakukan sembah sujud tiga kali kepada patung Buddha jika Anda beragama Buddha. Jika tidak, cukup dengan sikap tangan berdoa (anjali).'],
                ['icon' => 'volume_up',        'title' => 'Bicara Pelan', 'detail' => 'Bicara dengan suara pelan. Jangan bercanda atau tertawa keras. Meditasi membutuhkan keheningan total. Matikan ponsel.'],
                ['icon' => 'no_photography',   'title' => 'Foto & Video', 'detail' => 'Minta izin sebelum memotret. Jangan menggunakan flash pada patung Buddha. Jangan memotret bhikkhu tanpa izin.'],
                ['icon' => 'dining',           'title' => 'Dana Makanan', 'detail' => 'Jika memberikan dana makanan kepada bhikkhu, serahkan dengan tangan kanan. Wanita tidak boleh menyentuh bhikkhu secara langsung. Gunakan wadah perantara.'],
            ],
        ],
        'konghucu' => [
            'desc' => 'Panduan tata krama saat mengunjungi Klenteng (tempat ibadah Konghucu).',
            'rules' => [
                ['icon' => 'footwear',         'title' => 'Lepas Alas Kaki', 'detail' => 'Lepas sepatu sebelum memasuki ruang utama. Beberapa klenteng mengizinkan alas kaki di area tertentu. Ikuti kebiasaan setempat.'],
                ['icon' => 'checkroom',        'title' => 'Pakaian Sopan', 'detail' => 'Kenakan pakaian yang sopan dan bersih. Warna merah dan kuning dianggap baik. Hindari pakaian hitam putih (warna berkabung).'],
                ['icon' => 'local_fire_department', 'title' => 'Pembakaran Hio', 'detail' => 'Pembakaran hio (dupa/incense) adalah bagian dari ritual. Ikuti cara yang benar jika ingin berpartisipasi. Jumlah hio biasanya 3 batang.'],
                ['icon' => 'no_photography',   'title' => 'Altar & Roh Leluhur', 'detail' => 'Jangan menyentuh atau menggeser barang di altar. Jangan memotret altar tanpa izin. Hormati area sembahyang leluhur.'],
                ['icon' => 'volume_up',        'title' => 'Jaga Kesopanan', 'detail' => 'Bicara dengan sopan. Jangan menunjuk-nunjuk patung atau altar. Jangan duduk atau bersandar di meja altar. Ikuti arahan juru kunci klenteng.'],
            ],
        ],
    ];

    $meta = $religionMeta[$current];
    $etiquette = $etiquettes[$current];
    $gradient = [
        'islam'    => 'from-emerald-900 via-primary to-emerald-700',
        'kristen'  => 'from-blue-900 via-blue-700 to-blue-600',
        'katolik'  => 'from-violet-900 via-violet-700 to-violet-600',
        'hindu'    => 'from-orange-800 via-orange-600 to-orange-500',
        'buddha'   => 'from-amber-900 via-amber-700 to-amber-600',
        'konghucu' => 'from-red-800 via-red-600 to-red-500',
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">account_balance</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Etiket {{ $meta['place'] }}</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Breadcrumb / Pilih agama --}}
            @if ($religion)
                <div class="mb-4">
                    <a href="{{ route('ibadah.etiquette') }}" class="text-sm text-gray-400 hover:text-gray-600 inline-flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Semua Etiket
                    </a>
                </div>
            @endif

            {{-- Tab navigasi 6 agama (hanya jika tanpa slug) --}}
            @if (!$religion)
                <div class="bg-white shadow-sm rounded-2xl p-2 mb-6 overflow-x-auto">
                    <div class="flex gap-1 min-w-max">
                        @foreach ($validSlugs as $slug)
                            @php $m = $religionMeta[$slug]; @endphp
                            <a href="{{ route('ibadah.etiquette', $slug) }}"
                               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                                      {{ $current === $slug ? 'bg-gray-100 text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                                <span class="material-symbols-outlined text-lg {{ $current === $slug ? 'text-primary' : 'text-gray-400' }}">
                                    {{ $m['icon'] }}
                                </span>
                                {{ $m['place'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Hero --}}
            @if ($religion)
                <div class="bg-gradient-to-r {{ $gradient[$current] }} rounded-2xl p-6 sm:p-8 mb-6 text-white">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-5xl text-white/60 hidden sm:block">{{ $meta['icon'] }}</span>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold">Etiket ke {{ $meta['place'] }}</h1>
                            <p class="mt-1 text-white/80 text-sm sm:text-base">{{ $etiquette['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-gradient-to-r from-primary-800 to-primary rounded-2xl p-6 sm:p-8 mb-6 text-white">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-5xl text-white/60 hidden sm:block">account_balance</span>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold">Etiket Rumah Ibadah</h1>
                            <p class="mt-1 text-white/80 text-sm sm:text-base">Pilih agama untuk melihat tata krama saat mengunjungi rumah ibadah.</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Daftar etiket --}}
            @if ($religion)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($etiquette['rules'] as $rule)
                        <div class="bg-white rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-200 border border-gray-50">
                            <div class="flex items-start gap-4">
                                <span class="material-symbols-outlined text-2xl text-primary mt-0.5">{{ $rule['icon'] }}</span>
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $rule['title'] }}</h3>
                                    <p class="text-sm text-gray-500 mt-1 leading-relaxed">{{ $rule['detail'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                    @foreach ($validSlugs as $slug)
                        @php $m = $religionMeta[$slug]; @endphp
                        <a href="{{ route('ibadah.etiquette', $slug) }}"
                           class="group flex flex-col items-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-50 hover:border-gray-200">
                            <span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-primary transition-colors">{{ $m['icon'] }}</span>
                            <p class="mt-2 text-sm font-medium text-gray-700">{{ $m['place'] }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
