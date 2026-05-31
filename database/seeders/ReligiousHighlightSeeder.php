<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligiousHighlightSeeder extends Seeder
{
    public function run(): void
    {
        $religions = [
            'islam' => 1, 'kristen' => 2, 'katolik' => 3,
            'hindu' => 4, 'buddha' => 5, 'konghucu' => 6,
        ];

        $highlights = [
            // ─── ISLAM ────────────────────────────────────────────
            // Tempat Ibadah
            [
                'religion_id' => $religions['islam'],
                'type' => 'worship_place',
                'name' => 'Masjid Istiqlal',
                'description' => 'Masjid Istiqlal adalah masjid nasional Republik Indonesia yang terletak di Jakarta Pusat. Dengan kapasitas hingga 200.000 jamaah, masjid ini merupakan masjid terbesar di Asia Tenggara dan masjid terbesar keenam di dunia. Dirancang oleh arsitek Frederich Silaban, masjid ini dibangun sebagai simbol syukur atas kemerdekaan Indonesia. Nama "Istiqlal" berarti "kemerdekaan" dalam bahasa Arab. Masjid ini diresmikan pada 22 Februari 1978 oleh Presiden Soeharto. Arsitekturnya yang megah memadukan gaya modern dengan elemen tradisional Islam, dengan kubah besar berdiameter 45 meter yang melambangkan tahun kemerdekaan Indonesia.',
                'image_url' => 'images/religious-highlights/Mesjid-Istiqlal.jpg',
                'location' => 'Jl. Taman Wijaya Kusuma, Ps. Baru, Sawah Besar, Jakarta Pusat',
                'reference_url' => 'https://www.google.com/search?q=Masjid+Istiqlal+Jakarta',
                'sort_order' => 1,
            ],
            [
                'religion_id' => $religions['islam'],
                'type' => 'worship_place',
                'name' => 'Masjid Raya Baiturrahman',
                'description' => 'Masjid Raya Baiturrahman adalah masjid bersejarah yang terletak di pusat Kota Banda Aceh. Masjid ini merupakan simbol ketahanan dan kebanggaan masyarakat Aceh. Dibangun pertama kali pada tahun 1612 oleh Sultan Iskandar Muda, masjid ini telah beberapa kali mengalami renovasi dan perluasan. Salah satu momen paling bersejarah adalah ketika masjid ini selamat dari gempa dan tsunami dahsyat 26 Desember 2004 yang menghancurkan sebagian besar kota Banda Aceh. Arsitektur masjid ini memadukan gaya Mughal dan kolonial Belanda, dengan kubah hitam khas yang menjadi ikon kota.',
                'image_url' => 'images/religious-highlights/Baiturraman.jpg',
                'location' => 'Kp. Baru, Kec. Baiturrahman, Kota Banda Aceh',
                'reference_url' => 'https://www.google.com/search?q=Masjid+Raya+Baiturrahman+Aceh',
                'sort_order' => 2,
            ],
            // Tokoh Agama
            [
                'religion_id' => $religions['islam'],
                'type' => 'figure',
                'name' => 'Sunan Kalijaga',
                'description' => 'Sunan Kalijaga adalah salah satu dari Walisongo (sembilan wali) yang berperan besar dalam penyebaran Islam di tanah Jawa. Lahir dengan nama Raden Mas Said pada tahun 1450, ia adalah putra Adipati Tuban. Sunan Kalijaga dikenal dengan metode dakwahnya yang unik dan akulturatif — menggunakan seni dan budaya Jawa sebagai media penyebaran Islam. Beliau menciptakan berbagai karya seni seperti wayang kulit, tembang suluk, dan gamelan yang sarat dengan nilai-nilai keislaman. Filosofi "memayu hayuning bawana" (memperindah keindahan dunia) yang diajarkannya mencerminkan pendekatan toleran dan damai dalam berdakwah.',
                'image_url' => null,
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=Sunan+Kalijaga+Walisongo',
                'sort_order' => 3,
            ],
            [
                'religion_id' => $religions['islam'],
                'type' => 'figure',
                'name' => 'KH. Hasyim Asy\'ari',
                'description' => 'KH. Hasyim Asy\'ari adalah pendiri Nahdlatul Ulama (NU), organisasi Islam terbesar di Indonesia. Lahir di Jombang pada 14 Februari 1871, beliau adalah seorang ulama besar, pahlawan nasional, dan tokoh kunci dalam perkembangan Islam modern di Indonesia. Beliau mendirikan Pondok Pesantren Tebuireng yang menjadi salah satu pusat pendidikan Islam paling berpengaruh. Pada masa penjajahan, beliau mengeluarkan Resolusi Jihad pada 22 Oktober 1945 yang menjadi faktor penting dalam perjuangan kemerdekaan Indonesia. Pemikiran dan perjuangannya terus menginspirasi umat Islam Indonesia hingga hari ini.',
                'image_url' => null,
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=KH+Hasyim+Asyari+Nahdlatul+Ulama',
                'sort_order' => 4,
            ],
            // Tempat Sejarah
            [
                'religion_id' => $religions['islam'],
                'type' => 'historical_site',
                'name' => 'Masjid Agung Demak',
                'description' => 'Masjid Agung Demak adalah salah satu masjid tertua di Indonesia yang dibangun pada abad ke-15. Masjid ini merupakan saksi bisu penyebaran Islam di tanah Jawa oleh Walisongo. Menurut sejarah, masjid ini didirikan oleh para wali (Walisongo) pada tahun 1479 Masehi, dengan arsitektur utama dari Sunan Kalijaga. Salah satu keunikan masjid ini adalah salah satu tiang utamanya (saka) yang terbuat dari kumpulan kayu (saka tatal) yang merupakan karya Sunan Kalijaga. Masjid Agung Demak menjadi pusat penyebaran Islam dan simbol kejayaan Kesultanan Demak, kerajaan Islam pertama di Jawa.',
                'image_url' => 'images/religious-highlights/Masjid-agung-demak.jpg',
                'location' => 'Bintoro, Kec. Demak, Kabupaten Demak, Jawa Tengah',
                'reference_url' => 'https://www.google.com/search?q=Masjid+Agung+Demak+sejarah',
                'sort_order' => 5,
            ],

            // ─── KRISTEN ──────────────────────────────────────────
            // Tempat Ibadah
            [
                'religion_id' => $religions['kristen'],
                'type' => 'worship_place',
                'name' => 'Gereja Katedral Jakarta',
                'description' => 'Gereja Katedral Jakarta, dengan nama resmi Gereja Katedral Santa Maria Pelindung Diangkat ke Surga, adalah gereja Katolik terbesar di Indonesia. Terletak di pusat Jakarta, tepat di seberang Masjid Istiqlal, kedua tempat ibadah ini menjadi simbol toleransi beragama yang indah di Indonesia. Dibangun pada tahun 1901 dengan arsitektur neo-gotik yang megah, gereja ini memiliki dua menara kembar setinggi 60 meter. Interiornya dihiasi dengan jendela kaca patri yang indah dan patung-patung religius. Gereja ini menjadi pusat kegiatan keagamaan umat Katolik di Jakarta dan sering menjadi tujuan wisata religi.',
                'image_url' => 'images/religious-highlights/Gereja-Katedral-Jakarta.jpg',
                'location' => 'Jl. Katedral No.7, Ps. Baru, Sawah Besar, Jakarta Pusat',
                'reference_url' => 'https://www.google.com/search?q=Gereja+Katedral+Jakarta',
                'sort_order' => 6,
            ],
            [
                'religion_id' => $religions['kristen'],
                'type' => 'worship_place',
                'name' => 'GKJ Pasundan',
                'description' => 'Gereja Kristen Jawa (GKJ) Pasundan adalah salah satu gereja bersejarah di Jakarta yang mencerminkan akulturasi budaya Jawa dan Kristen. Didirikan pada awal abad ke-20, gereja ini menjadi pusat kegiatan jemaat Kristen Jawa di perantauan. Arsitekturnya memadukan gaya Eropa dengan sentuhan tradisional Jawa, menciptakan harmoni visual yang unik. Gereja ini tidak hanya menjadi tempat ibadah, tetapi juga pusat kegiatan sosial dan budaya yang melayani masyarakat sekitar.',
                'image_url' => 'images/religious-highlights/GKJ Pasundan.jpg',
                'location' => 'Jl. Pasundan No.56, Jakarta Pusat',
                'reference_url' => 'https://www.google.com/search?q=GKJ+Pasundan+Jakarta',
                'sort_order' => 7,
            ],
            // Tokoh Agama
            [
                'religion_id' => $religions['kristen'],
                'type' => 'figure',
                'name' => 'Pdt. Dr. Johannes Leimena',
                'description' => 'Dr. Johannes Leimena adalah pahlawan nasional Indonesia dan salah satu tokoh Kristen Protestan paling berpengaruh di Indonesia. Lahir di Ambon pada 6 Maret 1905, ia adalah seorang dokter dan politisi yang menjabat sebagai Wakil Perdana Menteri Indonesia pada era Presiden Soekarno. Sebagai seorang Kristen yang taat, ia dikenal karena perjuangannya dalam memperjuangkan toleransi beragama dan persatuan bangsa. Ia adalah salah satu perumus Pancasila dan aktif dalam berbagai organisasi lintas agama. Kontribusinya dalam membangun fondasi negara yang inklusif dan toleran sangat dihormati oleh semua kalangan.',
                'image_url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=800&q=80',
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=Johannes+Leimena+tokoh+Kristen',
                'sort_order' => 8,
            ],
            [
                'religion_id' => $religions['kristen'],
                'type' => 'figure',
                'name' => 'Pdt. Dr. Martin Luther King Jr.',
                'description' => 'Meskipun berkebangsaan Amerika, pengaruh Dr. Martin Luther King Jr. sangat terasa di Indonesia, khususnya dalam gerakan kesetaraan dan perdamaian. Sebagai pendeta Kristen dan aktivis hak sipil, ia memperjuangkan kesetaraan ras melalui perlawanan tanpa kekerasan (non-violence). Filosofi dan pendekatannya yang damai menginspirasi banyak tokoh dan gerakan di Indonesia. Pidato terkenalnya "I Have a Dream" menjadi simbol perjuangan melawan diskriminasi dan menjadi inspirasi bagi gerakan toleransi di seluruh dunia, termasuk di Indonesia.',
                'image_url' => 'https://images.unsplash.com/photo-1529050010015-86e0e72ea883?w=800&q=80',
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=Martin+Luther+King+toleransi',
                'sort_order' => 9,
            ],
            // Tempat Sejarah
            [
                'religion_id' => $religions['kristen'],
                'type' => 'historical_site',
                'name' => 'Gereja Blenduk Semarang',
                'description' => 'Gereja Blenduk adalah gereja Protestan tertua di Jawa Tengah yang terletak di kawasan Kota Lama Semarang. Dibangun pada tahun 1753 oleh komunitas Portugis dan Belanda, gereja ini memiliki arsitektur barok Eropa yang khas dengan kubah besar di bagian atasnya — yang dalam bahasa Jawa disebut "blenduk" yang berarti "menggelembung". Gereja ini menjadi saksi bisu perkembangan kota Semarang dari era kolonial hingga kemerdekaan. Interiornya masih mempertahankan elemen asli seperti mimbar marmer, organ pipa tua, dan bangku-bangku kayu jati yang artistik.',
                'image_url' => 'https://images.unsplash.com/photo-1548625361-e80e71c60b68?w=800&q=80',
                'location' => 'Kota Lama, Semarang, Jawa Tengah',
                'reference_url' => 'https://www.google.com/search?q=Gereja+Blenduk+Semarang+sejarah',
                'sort_order' => 10,
            ],

            // ─── KATOLIK ──────────────────────────────────────────
            // Tempat Ibadah
            [
                'religion_id' => $religions['katolik'],
                'type' => 'worship_place',
                'name' => 'Gereja Katedral Jakarta',
                'description' => 'Gereja Katedral Santa Maria Pelindung Diangkat ke Surga, yang lebih dikenal sebagai Gereja Katedral Jakarta, adalah pusat Keuskupan Agung Jakarta. Dibangun pada tahun 1901 dengan gaya neo-gotik yang memukau, gereja ini memiliki dua menara kembar yang menjulang setinggi 60 meter. Jendela-jendela kaca patri yang indah menggambarkan kisah-kisah Alkitab dan kehidupan orang-orang kudus. Kubahnya yang melengkung dan ornamen-ornamen detail mencerminkan keindahan arsitektur gereja Eropa. Gereja ini memiliki nilai sejarah dan spiritual yang tinggi bagi umat Katolik di Indonesia.',
                'image_url' => 'images/religious-highlights/Gereja-Katedral-Jakarta.jpg',
                'location' => 'Jl. Katedral No.7, Ps. Baru, Sawah Besar, Jakarta Pusat',
                'reference_url' => 'https://www.google.com/search?q=Katedral+Jakarta+Katolik',
                'sort_order' => 11,
            ],
            [
                'religion_id' => $religions['katolik'],
                'type' => 'worship_place',
                'name' => 'Gua Maria Kerep',
                'description' => 'Gua Maria Kerep adalah tempat ziarah Katolik yang terletak di lereng Gunung Sumbing, Ambarawa, Jawa Tengah. Tempat ini merupakan replika Gua Lourdes di Prancis yang dibangun pada tahun 1978. "Kerep" dalam bahasa Jawa berarti "sering" atau "kerap", mencerminkan banyaknya umat yang sering berkunjung untuk berdoa dan merenung. Dikelilingi oleh pemandangan alam yang asri dengan pohon-pohon rindang dan udara sejuk pegunungan, tempat ini menjadi oase spiritual yang damai. Setiap bulan Mei dan Oktober, ribuan peziarah datang untuk berdoa Rosario dan merenungkan misteri iman Katolik.',
                'image_url' => 'images/religious-highlights/goa_maria_kerep.jpg',
                'location' => 'Ambarawa, Kabupaten Semarang, Jawa Tengah',
                'reference_url' => 'https://www.google.com/search?q=Gua+Maria+Kerep+Ambarawa',
                'sort_order' => 12,
            ],
            // Tokoh Agama
            [
                'religion_id' => $religions['katolik'],
                'type' => 'figure',
                'name' => 'Romo YB Mangunwijaya',
                'description' => 'Romo Y.B. Mangunwijaya adalah seorang pastor, arsitek, penulis, dan aktivis sosial Indonesia yang terkenal. Lahir di Ambarawa pada 6 Mei 1929, ia dikenal karena perjuangannya membela rakyat kecil melalui karya dan aksinya. Sebagai arsitek, ia merancang kompleks Gereja dan Pusat Pastoral di Kaliurang yang memadukan arsitektur modern dengan kearifan lokal. Sebagai penulis, novelnya "Roro Mendut" dan "Burung-Burung Manyar" mendapat penghargaan sastra. Ia aktif dalam pembelaan hak-hak buruh tani dan masyarakat adat. Dedikasinya pada keadilan sosial membuatnya dihormati lintas agama.',
                'image_url' => 'https://images.unsplash.com/photo-1566933293069-b55c56f80987?w=800&q=80',
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=YB+Mangunwijaya+tokoh+Katolik',
                'sort_order' => 13,
            ],
            [
                'religion_id' => $religions['katolik'],
                'type' => 'figure',
                'name' => 'Paus Fransiskus',
                'description' => 'Paus Fransiskus, lahir sebagai Jorge Mario Bergoglio di Buenos Aires, Argentina pada 17 Desember 1936, adalah Paus Gereja Katolik sedunia sejak 2013. Beliau dikenal sebagai paus yang sederhana, rendah hati, dan sangat peduli pada isu-isu kemanusiaan. Kunjungannya ke Indonesia pada September 2024 menjadi momen bersejarah yang menunjukkan kedekatannya dengan umat Katolik di Asia. Pesannya tentang persaudaraan, dialog antaragama, dan kepedulian terhadap lingkungan (tertuang dalam ensiklik "Laudato Si") sangat relevan dengan semangat toleransi di Indonesia.',
                'image_url' => 'https://images.unsplash.com/photo-1529050010015-86e0e72ea883?w=800&q=80',
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=Paus+Fransiskus+kunjungan+Indonesia',
                'sort_order' => 14,
            ],
            // Tempat Sejarah
            [
                'religion_id' => $religions['katolik'],
                'type' => 'historical_site',
                'name' => 'Gereja Tua Siantar',
                'description' => 'Gereja Tua Siantar, atau Gereja Santa Maria Bunda Karmel, adalah salah satu gereja Katolik tertua di Sumatera Utara. Dibangun pada tahun 1892 oleh misionaris Belanda, gereja ini menyaksikan perjalanan panjang penyebaran agama Katolik di tanah Batak. Arsitektur kolonialnya yang klasik dengan dinding tebal dan jendela tinggi mencerminkan gaya bangunan Eropa abad ke-19 yang diadaptasi dengan iklim tropis. Gereja ini menjadi saksi sejarah perkembangan Kota Pematangsiantar dan telah bertahan melalui berbagai masa — dari kolonialisme, perang kemerdekaan, hingga era modern.',
                'image_url' => null,
                'location' => 'Jl. Gereja No.1, Pematangsiantar, Sumatera Utara',
                'reference_url' => 'https://www.google.com/search?q=Gereja+Tua+Siantar+sejarah',
                'sort_order' => 15,
            ],

            // ─── HINDU ────────────────────────────────────────────
            // Tempat Ibadah
            [
                'religion_id' => $religions['hindu'],
                'type' => 'worship_place',
                'name' => 'Pura Besakih',
                'description' => 'Pura Besakih adalah pura terbesar dan paling suci di Bali, terletak di lereng Gunung Agung — gunung tertinggi di Pulau Bali. Dikenal sebagai "Mother Temple" atau Pura Ibu, kompleks pura ini terdiri dari 23 pura yang tersebar di area seluas 3.000 hektar. Pura Besakih sudah ada sejak abad ke-8 dan terus dikembangkan hingga menjadi pusat spiritual umat Hindu Bali. Arsitekturnya yang megah dengan meru (menara bertingkat) yang menjulang dan gerbang candi bentar yang ikonik menjadikannya salah satu situs keagamaan terindah di Indonesia. Setiap tahun, ribuan umat Hindu melakukan persembahyangan di pura ini, terutama saat hari raya Idul Siwa dan Galungan.',
                'image_url' => 'images/religious-highlights/Pura_Bekasih.jpg',
                'location' => 'Besakih, Kec. Rendang, Kabupaten Karangasem, Bali',
                'reference_url' => 'https://www.google.com/search?q=Pura+Besakih+Bali',
                'sort_order' => 16,
            ],
            [
                'religion_id' => $religions['hindu'],
                'type' => 'worship_place',
                'name' => 'Pura Tanah Lot',
                'description' => 'Pura Tanah Lot adalah salah satu pura paling ikonik di Bali yang terletak di atas batu karang di tepi laut. Nama "Tanah Lot" berarti "tanah (yang berada) di laut" dalam bahasa Bali. Pura ini dibangun pada abad ke-16 oleh Dang Hyang Nirartha, seorang pendeta suci yang menyebarkan agama Hindu di Bali. Keunikan pura ini adalah lokasinya yang dikelilingi oleh laut saat air pasang, menciptakan pemandangan yang spektakuler. Saat air surut, pengunjung dapat berjalan mendekati pura. Pura Tanah Lot menjadi salah satu destinasi wisata religi dan budaya paling populer di Indonesia.',
                'image_url' => 'images/religious-highlights/Pura Tanah Lot.jpg',
                'location' => 'Beraban, Kediri, Kabupaten Tabanan, Bali',
                'reference_url' => 'https://www.google.com/search?q=Pura+Tanah+Lot+Bali',
                'sort_order' => 17,
            ],
            // Tokoh Agama
            [
                'religion_id' => $religions['hindu'],
                'type' => 'figure',
                'name' => 'Dang Hyang Nirartha',
                'description' => 'Dang Hyang Nirartha, juga dikenal sebagai Pedanda Sakti Wawu Rawuh, adalah seorang pendeta Hindu besar yang menyebarkan agama Hindu di Bali pada abad ke-16. Lahir di Jawa Timur, ia melakukan perjalanan spiritual ke Bali dan menjadi tokoh kunci dalam pembaruan dan penguatan Hindu di pulau tersebut. Beliau mendirikan banyak pura di Bali, termasuk Pura Tanah Lot dan Pura Uluwatu yang kini menjadi ikon wisata dan spiritual. Ajarannya tentang keseimbangan antara manusia, alam, dan Tuhan (Tri Hita Karana) masih menjadi fondasi kehidupan masyarakat Hindu Bali hingga saat ini.',
                'image_url' => null,
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=Dang+Hyang+Nirartha+tokoh+Hindu',
                'sort_order' => 18,
            ],
            [
                'religion_id' => $religions['hindu'],
                'type' => 'figure',
                'name' => 'Mpu Kuturan',
                'description' => 'Mpu Kuturan adalah seorang pendeta Hindu yang berperan besar dalam membangun tatanan sosial dan keagamaan di Bali pada abad ke-11. Beliau datang ke Bali dari Kerajaan Kediri di Jawa Timur dan memperkenalkan konsep Kahyangan Tiga — sistem tiga pura utama di setiap desa adat Bali (Pura Puseh, Pura Desa, dan Pura Dalem). Sistem ini menjadi fondasi struktur sosial dan spiritual masyarakat Bali hingga saat ini. Mpu Kuturan juga dikenal sebagai pencetus konsep karma dalam kehidupan bermasyarakat di Bali. Kontribusinya dalam membangun harmoni sosial-keagamaan sangat dihormati.',
                'image_url' => null,
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=Mpu+Kuturan+Bali',
                'sort_order' => 19,
            ],
            // Tempat Sejarah
            [
                'religion_id' => $religions['hindu'],
                'type' => 'historical_site',
                'name' => 'Candi Prambanan',
                'description' => 'Candi Prambanan adalah kompleks candi Hindu terbesar di Indonesia dan salah satu yang terindah di Asia Tenggara. Dibangun pada abad ke-9 oleh Kerajaan Mataram Kuno, candi ini didedikasikan untuk Trimurti — tiga dewa utama Hindu: Brahma (pencipta), Wisnu (pemelihara), dan Siwa (pelebur). Candi utama setinggi 47 meter menjulang megah di antara candi-candi kecil yang mengelilinginya. Relief-relief yang indah di dinding candi menceritakan kisah Ramayana dan Krishna. Situs Warisan Dunia UNESCO ini menjadi bukti kejayaan peradaban Hindu di Nusantara dan merupakan salah satu destinasi wisata budaya terpenting di Indonesia.',
                'image_url' => 'https://images.unsplash.com/photo-1528629297340-d1d466945dcf?w=800&q=80',
                'location' => 'Bokoharjo, Prambanan, Kabupaten Sleman, DIY',
                'reference_url' => 'https://www.google.com/search?q=Candi+Prambanan+sejarah+Hindu',
                'sort_order' => 20,
            ],

            // ─── BUDDHA ───────────────────────────────────────────
            // Tempat Ibadah
            [
                'religion_id' => $religions['buddha'],
                'type' => 'worship_place',
                'name' => 'Vihara Borobudur',
                'description' => 'Vihara Borobudur adalah sebuah vihara yang terletak di kompleks Candi Borobudur, Magelang, Jawa Tengah. Vihara ini menjadi pusat kegiatan keagamaan umat Buddha di kawasan Candi Borobudur, khususnya saat perayaan Hari Raya Waisak — hari suci umat Buddha yang memperingati kelahiran, pencerahan, dan parinirwana Siddhartha Gautama. Setiap tahun, ribuan biksu dan umat Buddha dari seluruh Indonesia dan mancanegara berkumpul di sini untuk melakukan prosesi Waisak yang megah dan penuh khidmat. Vihara ini juga menjadi tempat meditasi dan pembelajaran ajaran Buddha bagi umat yang ingin memperdalam spiritualitas.',
                'image_url' => 'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800&q=80',
                'location' => 'Borobudur, Magelang, Jawa Tengah',
                'reference_url' => 'https://www.google.com/search?q=Vihara+Borobudur+Magelang',
                'sort_order' => 21,
            ],
            [
                'religion_id' => $religions['buddha'],
                'type' => 'worship_place',
                'name' => 'Vihara Maha Bodhi',
                'description' => 'Vihara Maha Bodhi adalah salah satu vihara terbesar dan terpenting di Indonesia, terletak di Klaten, Jawa Tengah. Vihara ini dikenal dengan arsitekturnya yang indah memadukan gaya Tionghoa dan Jawa. Kompleks vihara yang luas ini memiliki berbagai fasilitas spiritual termasuk ruang meditasi, perpustakaan dharma, dan kuil utama yang megah dengan patung Buddha duduk yang besar. Vihara Maha Bodhi menjadi pusat pengajaran agama Buddha bagi masyarakat Jawa Tengah dan sekitarnya, serta menjadi tempat diselenggarakannya berbagai kegiatan keagamaan dan sosial kemasyarakatan.',
                'image_url' => 'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800&q=80',
                'location' => 'Jl. Sariwarni, Klaten, Jawa Tengah',
                'reference_url' => 'https://www.google.com/search?q=Vihara+Maha+Bodhi+Klaten',
                'sort_order' => 22,
            ],
            // Tokoh Agama
            [
                'religion_id' => $religions['buddha'],
                'type' => 'figure',
                'name' => 'Bhante Ashin Jinarakkhita',
                'description' => 'Bhante Ashin Jinarakkhita adalah biksu Buddha pertama yang berasal dari Indonesia modern dan merupakan tokoh kunci dalam kebangkitan agama Buddha di Indonesia pasca kemerdekaan. Lahir dengan nama Tee Boan An di Bogor pada 1923, ia ditahbiskan menjadi biksu di Myanmar pada 1953. Sekembalinya ke Indonesia, ia berperan besar dalam menyatukan berbagai aliran Buddha di Indonesia dan mendirikan organisasi Buddha tertinggi di Indonesia. Beliau juga yang memperkenalkan kembali ajaran Buddha kepada masyarakat Indonesia dan membangun banyak vihara di seluruh Nusantara. Dedikasinya dalam melestarikan dan mengembangkan Buddhisme di Indonesia tak ternilai.',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80',
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=Bhante+Ashin+Jinarakkhita+Buddha+Indonesia',
                'sort_order' => 23,
            ],
            [
                'religion_id' => $religions['buddha'],
                'type' => 'figure',
                'name' => 'Bhikkhu Sumananda',
                'description' => 'Bhikkhu Sumananda adalah seorang biksu Buddhist Theravada yang terkenal di Indonesia karena perjuangannya dalam dialog antarumat beragama. Lahir di Indonesia, ia memilih jalan hidup sebagai bhikkhu dan mendalami ajaran Buddha di Thailand dan Myanmar. Sekembalinya ke Indonesia, ia aktif dalam berbagai forum dialog lintas iman dan sering menjadi pembicara dalam acara-acara toleransi. Pandangannya yang inklusif dan moderat menjadikannya tokoh yang dihormati tidak hanya oleh umat Buddha tetapi juga oleh pemeluk agama lain. Kontribusinya dalam membangun jembatan antariman sangat berarti bagi kerukunan nasional.',
                'image_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800&q=80',
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=Bhikkhu+Sumananda+tokoh+Buddha',
                'sort_order' => 24,
            ],
            // Tempat Sejarah
            [
                'religion_id' => $religions['buddha'],
                'type' => 'historical_site',
                'name' => 'Candi Borobudur',
                'description' => 'Candi Borobudur adalah candi Buddha terbesar di dunia dan salah satu monumen Buddha paling megah. Dibangun pada abad ke-8 dan ke-9 oleh Dinasti Syailendra, candi ini terdiri dari sembilan platform bertingkat — enam berbentuk persegi dan tiga melingkar — yang dihiasi dengan 2.672 panel relief dan 504 patung Buddha. Struktur megah ini melambangkan kosmologi Buddha: dari dunia nafsu (Kamadhatu) ke dunia bentuk (Rupadhatu) hingga ke dunia tanpa bentuk (Arupadhatu). Situs Warisan Dunia UNESCO ini menjadi tujuan ziarah umat Buddha dari seluruh dunia, terutama saat perayaan Waisak. Keindahan arsitektur dan kedalaman spiritualnya membuat Borobudur menjadi kebanggaan Indonesia.',
                'image_url' => 'https://images.unsplash.com/photo-1598887142787-315bc0aeb63e?w=800&q=80',
                'location' => 'Borobudur, Magelang, Jawa Tengah',
                'reference_url' => 'https://www.google.com/search?q=Candi+Borobudur+sejarah+Buddha',
                'sort_order' => 25,
            ],
            [
                'religion_id' => $religions['buddha'],
                'type' => 'historical_site',
                'name' => 'Candi Mendut',
                'description' => 'Candi Mendut adalah candi Buddha yang terletak tidak jauh dari Candi Borobudur, diperkirakan dibangun pada abad ke-9 oleh Dinasti Syailendra. Di dalam candi terdapat arca Buddha berukuran besar yang duduk dengan sikap Dharmachakra Mudra (memutar roda dharma) setinggi 3 meter, serta arca Bodhisattva Avalokitesvara dan Vajrapani. Candi Mendut memiliki hubungan spiritual yang erat dengan Candi Borobudur dan Candi Pawon — ketiganya membentuk garis lurus yang digunakan sebagai jalur prosesi perayaan Waisak. Relief-relief di dinding Candi Mendut menceritakan kisah-kisah Jataka tentang kehidupan Buddha sebelumnya.',
                'image_url' => 'https://images.unsplash.com/photo-1564760055775-d63b17a55c44?w=800&q=80',
                'location' => 'Mendut, Kec. Mungkid, Kabupaten Magelang, Jawa Tengah',
                'reference_url' => 'https://www.google.com/search?q=Candi+Mendut+sejarah+Buddha',
                'sort_order' => 26,
            ],

            // ─── KONGHUCU ─────────────────────────────────────────
            // Tempat Ibadah
            [
                'religion_id' => $religions['konghucu'],
                'type' => 'worship_place',
                'name' => 'Klenteng Sam Poo Kong',
                'description' => 'Klenteng Sam Poo Kong adalah klenteng bersejarah yang terletak di Semarang, Jawa Tengah. Klenteng ini didirikan untuk menghormati Laksamana Cheng Ho (Zheng He), seorang laksamana Muslim Tiongkok yang berlayar ke Nusantara pada abad ke-15. Bangunan ini memadukan arsitektur Tionghoa, Jawa, dan Islam yang mencerminkan akulturasi budaya yang unik. Kompleks klenteng yang luas ini terdiri dari beberapa bangunan dengan ornamen naga khas Tionghoa, lampion merah, dan patung-patung dewa. Setiap tahun, perayaan Cap Go Meh di klenteng ini menjadi atraksi budaya yang meriah, dihadiri oleh ribuan pengunjung dari berbagai latar belakang.',
                'image_url' => 'https://images.unsplash.com/photo-1518659526054-190340b32700?w=800&q=80',
                'location' => 'Jl. Simongan No.129, Semarang, Jawa Tengah',
                'reference_url' => 'https://www.google.com/search?q=Klenteng+Sam+Poo+Kong+Semarang',
                'sort_order' => 27,
            ],
            [
                'religion_id' => $religions['konghucu'],
                'type' => 'worship_place',
                'name' => 'Kelenteng Boen Tek Bio',
                'description' => 'Kelenteng Boen Tek Bio adalah salah satu kelenteng tertua di Tangerang yang dibangun pada tahun 1684 oleh komunitas Tionghoa perantauan. Kelenteng ini merupakan pusat ibadah umat Konghucu dan juga menjadi simbol sejarah panjang migrasi Tionghoa ke Indonesia. Arsitektur kelenteng ini khas Tionghoa tradisional dengan atap melengkung, ornamen naga, dan lampion merah yang mendominasi. Di dalamnya terdapat altar-altar untuk bersembahyang kepada Tian (Tuhan) dan leluhur. Kelenteng Boen Tek Bio menjadi saksi bisu perjalanan panjang umat Konghucu di Indonesia dari masa kolonial hingga era reformasi.',
                'image_url' => 'https://images.unsplash.com/photo-1518659526054-190340b32700?w=800&q=80',
                'location' => 'Jl. Cilacap No.1, Sukasari, Tangerang, Banten',
                'reference_url' => 'https://www.google.com/search?q=Kelenteng+Boen+Tek+Bio+Tangerang',
                'sort_order' => 28,
            ],
            // Tokoh Agama
            [
                'religion_id' => $religions['konghucu'],
                'type' => 'figure',
                'name' => 'Nabi Konghucu (Confucius)',
                'description' => 'Nabi Konghucu (Confucius) adalah seorang filsuf, guru, dan tokoh spiritual yang ajarannya menjadi fondasi agama Konghucu. Lahir pada 551 SM di negara bagian Lu (kini bagian dari Provinsi Shandong, Tiongkok), ajarannya berfokus pada etika, moralitas, dan hubungan antarmanusia. Konsep utamanya termasuk Ren (kemanusiaan), Yi (kebenaran), Li (tata krama), dan Xiao (bakti kepada orang tua). Ajarannya tentang harmoni sosial dan pemerintahan yang bijaksana sangat berpengaruh di Tiongkok dan Asia Timur selama ribuan tahun. Di Indonesia, ajaran Konghucu diakui sebagai salah satu agama resmi dan diikuti oleh sebagian masyarakat Tionghoa Indonesia.',
                'image_url' => null,
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=Nabi+Konghucu+Confucius+ajaran',
                'sort_order' => 29,
            ],
            [
                'religion_id' => $religions['konghucu'],
                'type' => 'figure',
                'name' => 'Mencius (Mengzi)',
                'description' => 'Mencius (Mengzi) adalah seorang filsuf Tiongkok kuno yang merupakan pengikut setia ajaran Konghucu dan mengembangkan lebih lanjut pemikiran Konfusianisme. Hidup pada abad ke-4 SM (372-289 SM), ia dikenal sebagai "Confucius Kedua" karena kontribusinya yang besar dalam memperkuat dan mengembangkan ajaran Konghucu. Mencius terkenal dengan ajarannya bahwa sifat dasar manusia adalah baik (xing shan), dan bahwa kejahatan muncul karena pengaruh lingkungan yang buruk. Pemikirannya tentang hak rakyat untuk menggulingkan penguasa yang lalim menjadi fondasi pemikiran politik yang berpengaruh di Asia Timur.',
                'image_url' => null,
                'location' => null,
                'reference_url' => 'https://www.google.com/search?q=Mencius+Mengzi+tokoh+Konghucu',
                'sort_order' => 30,
            ],
            // Tempat Sejarah
            [
                'religion_id' => $religions['konghucu'],
                'type' => 'historical_site',
                'name' => 'Kawasan Klenteng Tua Surabaya',
                'description' => 'Kawasan Klenteng Tua di Surabaya, khususnya Klenteng Sanggar Agung dan Klenteng Hong San Koo, merupakan kawasan bersejarah yang menjadi pusat ibadah dan budaya Tionghoa di Jawa Timur. Klenteng-klenteng ini sudah berdiri sejak abad ke-19 dan menjadi saksi sejarah perkembangan komunitas Tionghoa di Surabaya. Kawasan ini terletak di daerah Kampung Toleransi yang juga dihuni oleh berbagai komunitas agama. Arsitektur klenteng dengan warna merah menyala, ukiran naga, dan lampion menciptakan suasana yang khas. Kawasan ini menjadi bukti nyata keberagaman dan toleransi yang telah berlangsung selama berabad-abad di Indonesia.',
                'image_url' => 'https://images.unsplash.com/photo-1518659526054-190340b32700?w=800&q=80',
                'location' => 'Kawasan Pecinan, Jl. Kembang Jepun, Surabaya, Jawa Timur',
                'reference_url' => 'https://www.google.com/search?q=Klenteng+tua+Surabaya+sejarah+Konghucu',
                'sort_order' => 31,
            ],
        ];

        DB::connection()->getPdo()->exec('DELETE FROM religious_highlights');

        foreach (array_chunk($highlights, 5) as $chunk) {
            DB::table('religious_highlights')->insert(array_map(fn ($item) => [
                'religion_id' => $item['religion_id'],
                'type' => $item['type'],
                'name' => $item['name'],
                'description' => $item['description'],
                'image_url' => $item['image_url'],
                'location' => $item['location'],
                'reference_url' => $item['reference_url'],
                'sort_order' => $item['sort_order'],
                'created_at' => now(),
                'updated_at' => now(),
            ], $chunk));
        }
    }
}
