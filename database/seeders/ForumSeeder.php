<?php

namespace Database\Seeders;

use App\Models\ForumMessage;
use App\Models\ForumParticipant;
use App\Models\ForumRoom;
use App\Models\User;
use Illuminate\Database\Seeder;

class ForumSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@harmoni-nusantara.com'],
            [
                'name' => 'Admin Harmoni',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        $room = ForumRoom::create([
            'name' => 'Ruang Bersama Harmoni Nusantara',
            'description' => 'Tempat berdialog tentang agama, toleransi, dan kebersamaan. Gunakan @ai untuk bertanya kepada asisten AI.',
            'user_id' => $admin->id,
            'is_active' => true,
        ]);

        ForumParticipant::create([
            'forum_room_id' => $room->id,
            'user_id' => $admin->id,
            'role' => 'creator',
            'status' => 'active',
        ]);

        ForumMessage::create([
            'forum_room_id' => $room->id,
            'user_id' => $admin->id,
            'content' => 'Selamat datang di Ruang Bersama Harmoni Nusantara! 🎉 Mari kita berdialog tentang keberagaman agama di Indonesia dengan saling menghormati. Ketik @ai diikuti pertanyaanmu untuk bertanya kepada asisten AI.',
            'is_ai' => false,
            'created_at' => now(),
        ]);

        ForumMessage::create([
            'forum_room_id' => $room->id,
            'user_id' => null,
            'content' => 'Halo! Saya asisten AI Harmoni Nusantara. Saya siap membantu menjawab pertanyaan seputar sejarah agama, panduan ibadah, etika beragama, dan toleransi di Indonesia. Cukup ketik @ai diikuti pertanyaanmu! 😊',
            'is_ai' => true,
            'created_at' => now()->addSeconds(2),
        ]);
    }
}
