<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Announcement::create([
            'title' => 'Pengumuman Penting',
            'content' => 'Selamat datang di E-Audit. Mohon periksa kembali data Anda secara berkala. Sistem sedang dalam masa pemeliharaan rutin pada pukul 00:00 - 02:00 WIB.',
            'is_active' => true,
        ]);

        Announcement::create([
            'title' => 'Update Sistem Baru',
            'content' => 'Versi terbaru 2.0 telah dirilis dengan perbaikan bug dan peningkatan kinerja. Pastikan browser Anda diperbarui.',
            'is_active' => true,
        ]);
    }
}
