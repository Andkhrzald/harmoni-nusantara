<?php

namespace Database\Seeders;

use App\Models\ReligionCategory;
use Illuminate\Database\Seeder;

class ReligionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            [
                'slug' => 'islam',
                'name' => 'Islam',
                'description' => 'Agama dengan jumlah umat terbesar di Indonesia. Islam mengajarkan Tauhid dan mengikuti Al-Quran serta Sunnah.',
            ],
            [
                'slug' => 'kristen',
                'name' => 'Kristen Protestan',
                'description' => 'Agama Abrahamik yang percaya kepada Jesus Kristus sebagai Anak Tuhan dan Juruselamat.',
            ],
            [
                'slug' => 'katolik',
                'name' => 'Katolik',
                'description' => 'Gereja Katolik adalah salah satu denominasi Kristen terbesar dengan sejarah dan tradisi yang panjang.',
            ],
            [
                'slug' => 'hindu',
                'name' => 'Hindu',
                'description' => 'Agama dengan akar sejarah di India yang menekankan dharma, karma, dan moksha.',
            ],
            [
                'slug' => 'buddha',
                'name' => 'Buddha',
                'description' => 'Agama yang berlandaskan ajaran Siddhartha Gautama tentang jalan tengah menuju pencerahan.',
            ],
            [
                'slug' => 'konghucu',
                'name' => 'Konghucu',
                'description' => 'Agama yang berlandaskan ajaran Konfusius tentang manusia, langit, dan bumi.',
            ],
        ];

        foreach ($religions as $religion) {
            ReligionCategory::updateOrCreate(
                ['slug' => $religion['slug']],
                $religion
            );
        }
    }
}
