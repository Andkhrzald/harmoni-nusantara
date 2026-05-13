<x-app-layout>
    @section('title', 'Panduan Ritual ' . ucfirst($religion))
    @php
    $validSlugs = ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu'];
    $current = in_array($religion, $validSlugs) ? $religion : 'islam';

    $religionMeta = [
        'islam'    => ['icon' => 'mosque',        'color' => 'emerald', 'accent' => 'accent-gold',      'label' => 'Islam'],
        'kristen'  => ['icon' => 'church',        'color' => 'blue',    'accent' => 'yellow-300',       'label' => 'Kristen'],
        'katolik'  => ['icon' => 'church',        'color' => 'violet',  'accent' => 'yellow-300',       'label' => 'Katolik'],
        'hindu'    => ['icon' => 'temple_hindu',   'color' => 'orange',  'accent' => 'yellow-200',       'label' => 'Hindu'],
        'buddha'   => ['icon' => 'temple_buddhist','color' => 'amber',   'accent' => 'yellow-200',       'label' => 'Buddha'],
        'konghucu' => ['icon' => 'temple_buddhist','color' => 'red',     'accent' => 'yellow-200',       'label' => 'Konghucu'],
    ];

    $guides = [
        'islam' => [
            'desc' => 'Panduan lengkap ibadah sehari-hari bagi umat Muslim sesuai Al-Qur\'an dan Sunnah.',
            'items' => [
                ['title' => 'Salat 5 Waktu', 'icon' => 'mosque', 'desc' => 'Salat wajib yang dilaksanakan pada waktu Subuh (2 rakaat), Zuhur (4), Asar (4), Magrib (3), dan Isya (4). Setiap salat diawali dengan takbiratul ihram dan diakhiri dengan salam.', 'detail' => 'Syarat sah salat: suci dari hadas (wudhu), menutup aurat, menghadap kiblat, waktu yang tepat. Rukun salat: niat, takbiratul ihram, berdiri jika mampu, membaca Al-Fatihah, rukuk, i\'tidal, sujud, duduk di antara dua sujud, tasyahud akhir, salam.'],
                ['title' => 'Wudhu', 'icon' => 'water_drop', 'desc' => 'Bersuci dengan air sebelum salat. Wudhu wajib dilakukan sebelum menyentuh Al-Qur\'an dan melaksanakan salat.', 'detail' => 'Rukun wudhu: niat, membasuh muka, membasuh tangan hingga siku, mengusap sebagian kepala, membasuh kaki hingga mata kaki, tertib. Sunah wudhu: berkumur, membersihkan hidung, mengusap telinga, mendahulukan kanan.'],
                ['title' => 'Puasa Ramadan', 'icon' => 'nights_stay', 'desc' => 'Menahan diri dari makan, minum, dan hawa nafsu dari terbit fajar hingga terbenam matahari selama bulan Ramadan.', 'detail' => 'Rukun puasa: niat (malam hari) dan menahan diri dari hal-hal yang membatalkan. Yang membatalkan: makan-minum sengaja, muntah sengaja, haid/nifas, hubungan suami-istri di siang hari. Yang dimaafkan: lupa, terpaksa, sakit, musafir.'],
                ['title' => 'Zakat', 'icon' => 'volunteer_activism', 'desc' => 'Membersihkan harta dengan mengeluarkan sebagian untuk yang berhak. Zakat fitrah wajib sebelum Idul Fitri.', 'detail' => 'Zakat fitrah: 3,5 liter/2,5 kg makanan pokok per jiwa. Zakat mal: 2,5% dari harta yang telah mencapai nisab (85 gram emas) dan haul (1 tahun). 8 golongan penerima: fakir, miskin, amil, mualaf, hamba sahaya, gharim, fisabilillah, ibnu sabil.'],
                ['title' => 'Haji & Umrah', 'icon' => 'flight', 'desc' => 'Ibadah ke Baitullah di Mekah. Haji wajib sekali seumur hidup bagi yang mampu. Umrah bisa dilakukan kapan saja.', 'detail' => 'Rukun haji: ihram, wukuf di Arafah, tawaf ifadah, sai, tahalul, tertib. Wajib haji: niat ihram dari miqat, bermalam di Muzdalifah dan Mina, melontar jumrah. Larangan ihram: memakai wangi-wangian, memotong kuku/rambut, berburu, menikah.'],
            ],
        ],
        'kristen' => [
            'desc' => 'Panduan ibadah dan kehidupan rohani bagi umat Kristen Protestan.',
            'items' => [
                ['title' => 'Ibadah Minggu', 'icon' => 'church', 'desc' => 'Ibadah utama setiap hari Minggu yang terdiri dari pujian penyembahan, pembacaan firman Tuhan, khotbah, dan persembahan.', 'detail' => 'Liturgi ibadah umumnya: pujian pembukaan, doa, pembacaan Alkitab, khotbah, persembahan, doa syafaat, berkat penutup. Beberapa gereja memiliki tata ibadah yang lebih formal (liturgis) atau lebih bebas (kontemporer).'],
                ['title' => 'Doa & Meditasi', 'icon' => 'prayer_times', 'desc' => 'Komunikasi pribadi dengan Tuhan melalui doa, meditasi firman, dan saat teduh setiap hari.', 'detail' => 'Jenis doa: doa pujian, doa syukur, doa permohonan, doa syafaat, doa pengakuan. Saat teduh (quiet time): membaca Alkitab, merenungkan, berdoa. Pola doa yang diajarkan Yesus: Doa Bapa Kami.'],
                ['title' => 'Sakramen Baptis', 'icon' => 'water', 'desc' => 'Tanda penerimaan seseorang menjadi anggota gereja dan pengakuan iman kepada Yesus Kristus.', 'detail' => 'Baptis dewasa: penyelaman penuh dalam air sebagai simbol kematian dan kebangkitan bersama Kristus. Baptis anak: percikan air sebagai tanda perjanjian. Makna baptis: pengampunan dosa, kelahiran baru, masuk dalam persekutuan orang percaya.'],
                ['title' => 'Perjamuan Kudus', 'icon' => 'breakfast_dining', 'desc' => 'Peringatan akan pengorbanan Yesus Kristus melalui roti dan anggur yang melambangkan tubuh dan darah-Nya.', 'detail' => 'Dasar Alkitab: 1 Korintus 11:23-26. Roti melambangkan tubuh Kristus yang dipecahkan. Anggur melambangkan darah Kristus yang dicurahkan. Dilakukan dengan sikap introspeksi dan pengakuan dosa. Frekuensi bervariasi: mingguan, bulanan, atau triwulanan.'],
            ],
        ],
        'katolik' => [
            'desc' => 'Panduan ibadah dan sakramen dalam tradisi Gereja Katolik.',
            'items' => [
                ['title' => 'Misa Kudus', 'icon' => 'church', 'desc' => 'Perayaan Ekaristi yang merupakan puncak ibadah Gereja Katolik, terdiri dari Liturgi Sabda dan Liturgi Ekaristi.', 'detail' => 'Bagian misa: Ritus Pembuka (tanda salib, pengakuan dosa, kemuliaan), Liturgi Sabda (bacaan, injil, khotbah), Liturgi Ekaristi (persembahan, konsekrasi, komuni), Ritus Penutup (berkat, amanat). Kehadiran minggu dan hari raya adalah kewajiban.'],
                ['title' => 'Tujuh Sakramen', 'icon' => 'stars', 'desc' => 'Tanda rahmat Allah yang kudus yang ditetapkan oleh Kristus dan dipercayakan kepada Gereja.', 'detail' => '1) Baptis — pintu masuk gereja. 2) Krisma — penguatan iman. 3) Ekaristi — tubuh Kristus. 4) Tobat — pengakuan dosa. 5) Minyak Suci — pengurapan orang sakit. 6) Imamat — tahbisan. 7) Perkawinan — ikatan suci.'],
                ['title' => 'Doa Rosario', 'icon' => 'repeat', 'desc' => 'Doa renungan misteri kehidupan Yesus dan Maria dengan menggunakan rangkaian butir rosario.', 'detail' => 'Rosario terdiri dari 5 peristiwa (misteri): Gembira, Sedih, Mulia, dan Terang. Setiap peristiwa direnungkan sambil mendaraskan Bapa Kami, 10 Salam Maria, dan Kemuliaan. Bulan Oktober dan Mei adalah bulan Rosario dan Maria.'],
            ],
        ],
        'hindu' => [
            'desc' => 'Panduan ibadah dan persembahan dalam ajaran Agama Hindu.',
            'items' => [
                ['title' => 'Tri Sandhya', 'icon' => 'wb_twilight', 'desc' => 'Sembahyang tiga waktu sehari yang dilakukan umat Hindu sebagai kewajiban spiritual harian.', 'detail' => 'Tri Sandhya dilakukan pada pagi (pradakshina), siang (madhyahna), dan sore (sandhya). Mantra-mantra diambil dari Reg Weda dan Yajur Weda. Meliputi Gayatri Mantra yang disucikan, puja trisandya, dan doa penutup.'],
                ['title' => 'Puja & Persembahan', 'icon' => 'temple_hindu', 'desc' => 'Ibadah dengan sesajen (banten) dan doa kepada Hyang Widhi Wasa beserta manifestasi-Nya.', 'detail' => 'Jenis banten: banten sehari-hari (canang sari), banten hari raya (banten odalan), banten upacara (banten yadnya). Unsur banten: bunga, buah, makanan, dupa. Warna bunga memiliki makna: putih (Iswara), merah (Brahma), kuning (Mahadewa), hitam (Wisnu).'],
                ['title' => 'Hari Raya Nyepi', 'icon' => 'dark_mode', 'desc' => 'Tahun Baru Saka yang dirayakan dengan berdiam diri total, tidak bekerja, tidak bepergian, tidak menyalakan api.', 'detail' => 'Rangkaian Nyepi: Melasti (pembersihan), Tawur Agung (pecaruan), Nyepi (diam total 24 jam), Ngembak Geni (bersilaturahmi). Catur Bratha Penyepian: amati geni (tiada api), amati karya (tiada kerja), amati lelungan (tiada bepergian), amati lelanguan (tiada hiburan).'],
            ],
        ],
        'buddha' => [
            'desc' => 'Panduan meditasi dan ibadah dalam ajaran Agama Buddha.',
            'items' => [
                ['title' => 'Meditasi (Bhavana)', 'icon' => 'self_improvement', 'desc' => 'Latihan mental untuk menenangkan pikiran, mengembangkan kesadaran, dan mencapai pencerahan.', 'detail' => 'Dua jenis meditasi: Samatha (menenangkan pikiran) dengan fokus pada napas atau objek tertentu, dan Vipassana (pandangan terang) dengan mengamati fenomena fisik dan mental. Postur: duduk bersila, punggung tegak, tangan di pangkuan.'],
                ['title' => 'Puja & Persembahan', 'icon' => 'temple_buddhist', 'desc' => 'Penghormatan kepada Buddha, Dhamma (ajaran), dan Sangha (bhikkhu) melalui puja bakti dan persembahan.', 'detail' => 'Puja bakti: puji-pujian, pembacaan paritta/sutta, meditasi, dana paramita. Persembahan: lilin, bunga, dupa, air, makanan. Makna: liliN = penerangan, bunga = ketidakkekalan, dupa = moralitas yang semerbak.'],
                ['title' => 'Hari Raya Waisak', 'icon' => 'celebration', 'desc' => 'Hari suci yang memperingati kelahiran, pencerahan, dan parinibbana (wafat) Siddharta Gautama.', 'detail' => 'Rangkaian Waisak: pengambilan air suci, pradaksina (jalan keliling candi), meditasi bersama, puja bakti, pelepasan lampion. Di Indonesia, perayaan dipusatkan di Candi Borobudur dan Candi Mendut. Umat memberikan dana makanan kepada bhikkhu (dana paramita).'],
            ],
        ],
        'konghucu' => [
            'desc' => 'Panduan ibadah dan ritual dalam ajaran Agama Konghucu (Khong Hu Cu).',
            'items' => [
                ['title' => 'Sembahyang kepada Tian', 'icon' => 'temple_buddhist', 'desc' => 'Ibadah kepada Tuhan Yang Maha Esa (Tian) sebagai sumber segala kehidupan dan kebajikan.', 'detail' => 'Sembahyang dilakukan dengan sikap khusyuk, berdiri tegak dengan tangan terlipat di depan dada. Doa ditujukan kepada Tian, leluhur, dan para nabi. Waktu sembahyang: pagi dan sore hari, serta pada hari-hari raya tertentu.'],
                ['title' => 'Ritual Cap Go Meh', 'icon' => 'celebration', 'desc' => 'Puncak perayaan Tahun Baru Imlek pada hari ke-15 yang dirayakan dengan sembahyang dan kebersamaan.', 'detail' => 'Rangkaian: sembahyang syukur, sembahyang leluhur, makan bersama, lampion, barongsai. Makna: permohonan keselamatan, kemakmuran, dan keharmonisan untuk tahun yang baru. Tradisi lampion melambangkan penerangan jalan hidup.'],
                ['title' => 'Penghormatan Leluhur', 'icon' => 'family_history', 'desc' => 'Bakti kepada leluhur sebagai wujud rasa syukur dan penghormatan atas jasa-jasa mereka.', 'detail' => 'Dilakukan di rumah (altar leluhur) atau di klenteng. Persembahan: dupa, lilin, teh, buah, makanan kesukaan almarhum. Bukan menyembah, melainkan menghormati dan mendoakan. Prinsip utama: filial piety (xiao) — bakti kepada orang tua dan leluhur.'],
            ],
        ],
    ];

    $meta = $religionMeta[$current];
    $guide = $guides[$current];
    $gradient = [
        'islam'    => 'from-emerald-900 via-primary to-emerald-700',
        'kristen'  => 'from-blue-900 via-blue-700 to-blue-600',
        'katolik'  => 'from-violet-900 via-violet-700 to-violet-600',
        'hindu'    => 'from-orange-800 via-orange-600 to-orange-500',
        'buddha'   => 'from-amber-900 via-amber-700 to-amber-600',
        'konghucu' => 'from-red-800 via-red-600 to-red-500',
    ];
    $tabColors = [
        'islam'    => 'text-emerald-700 bg-emerald-50',
        'kristen'  => 'text-blue-700 bg-blue-50',
        'katolik'  => 'text-violet-700 bg-violet-50',
        'hindu'    => 'text-orange-700 bg-orange-50',
        'buddha'   => 'text-amber-700 bg-amber-50',
        'konghucu' => 'text-red-700 bg-red-50',
    ];
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-2xl text-primary">live_help</span>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panduan Ibadah</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Tab navigasi 6 agama (hanya muncul jika $religion == null, alias dari /ibadah/panduan tanpa slug) --}}
            @if (!$religion)
                <div class="bg-white shadow-sm rounded-2xl p-2 mb-6 overflow-x-auto">
                    <div class="flex gap-1 min-w-max">
                        @foreach ($validSlugs as $slug)
                            @php $m = $religionMeta[$slug]; @endphp
                            <a href="{{ route('ibadah.guide', $slug) }}"
                               class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                                      {{ $current === $slug ? 'bg-gray-100 text-gray-800 shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50' }}">
                                <span class="material-symbols-outlined text-lg {{ $current === $slug ? 'text-primary' : 'text-gray-400' }}">
                                    {{ $m['icon'] }}
                                </span>
                                {{ $m['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                {{-- Breadcrumb: menunjukkan agama yang sedang aktif --}}
                <div class="mb-4">
                    <a href="{{ route('ibadah.guide') }}" class="text-sm text-gray-400 hover:text-gray-600 inline-flex items-center gap-1">
                        <span class="material-symbols-outlined text-sm">arrow_back</span>
                        Semua Panduan Ibadah
                    </a>
                </div>
            @endif

            {{-- Hero (hanya tampil jika religion spesifik dipilih) --}}
            @if ($religion)
                <div class="bg-gradient-to-r {{ $gradient[$current] }} rounded-2xl p-6 sm:p-8 mb-6 text-white">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-5xl text-white/60 hidden sm:block">{{ $meta['icon'] }}</span>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold">Panduan Ibadah {{ $meta['label'] }}</h1>
                            <p class="mt-1 text-white/80 text-sm sm:text-base">{{ $guide['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @else
                {{-- Hero generik jika tanpa religion --}}
                <div class="bg-gradient-to-r from-primary-800 to-primary rounded-2xl p-6 sm:p-8 mb-6 text-white">
                    <div class="flex items-start gap-4">
                        <span class="material-symbols-outlined text-5xl text-white/60 hidden sm:block">live_help</span>
                        <div>
                            <h1 class="text-2xl sm:text-3xl font-bold">Panduan Ibadah</h1>
                            <p class="mt-1 text-white/80 text-sm sm:text-base">Pilih agama untuk melihat panduan ibadah dan ritual keagamaan.</p>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Konten panduan --}}
            @if ($religion)
                <div class="space-y-4">
                    @foreach ($guide['items'] as $index => $item)
                        <div x-data="{ open: false }"
                             class="bg-white rounded-2xl shadow-sm overflow-hidden transition-all duration-200 hover:shadow-md">
                            <button @click="open = ! open"
                                    class="w-full flex items-center gap-4 px-6 py-5 text-left transition-colors hover:bg-gray-50">
                                <span class="material-symbols-outlined text-2xl text-primary">{{ $item['icon'] }}</span>
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                                        {{ $index + 1 }}. {{ $item['title'] }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-0.5 line-clamp-1">{{ $item['desc'] }}</p>
                                </div>
                                <span class="material-symbols-outlined text-gray-400 transition-transform duration-200"
                                      :class="{ 'rotate-180': open }">expand_more</span>
                            </button>
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 max-h-0"
                                 x-transition:enter-end="opacity-100 max-h-[1000px]"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 max-h-[1000px]"
                                 x-transition:leave-end="opacity-0 max-h-0"
                                 class="border-t border-gray-100"
                                 style="display: none;">
                                <div class="px-6 py-5">
                                    <p class="text-gray-600 leading-relaxed">{{ $item['detail'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Pilih agama grid --}}
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                    @foreach ($validSlugs as $slug)
                        @php $m = $religionMeta[$slug]; @endphp
                        <a href="{{ route('ibadah.guide', $slug) }}"
                           class="group flex flex-col items-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all border border-gray-50 hover:border-gray-200">
                            <span class="material-symbols-outlined text-3xl text-gray-400 group-hover:text-primary transition-colors">{{ $m['icon'] }}</span>
                            <p class="mt-2 text-sm font-medium text-gray-700">{{ $m['label'] }}</p>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
