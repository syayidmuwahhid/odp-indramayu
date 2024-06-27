<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 0,
        ]);

        Profile::create([
            'id' => 1,
            'app_name' => 'OPD Indramayu',
            'title' => 'Organisasi Pemerintah Daerah Indramayu',
            'icon' => 'assets/img/favicon.png',
            'description' => 'Deskripsi Indramayu',
            'keywords' => 'opd indramayu, pemerintahan daerah Indramayu,informasi publik Indramayu,berita Indramayu terkini,layanan publik Indramayu',
            'tags' => 'OPD, Indramayu',
            'facebook' => 'https://www.facebook.com/diskominfo.indramayu',
            'youtube' => 'https://www.youtube.com/@diskominfoindramayu8327',
            'x' => 'https://twitter.com/indramayukab',
            'instagram' => 'https://www.instagram.com/diskominfoindramayu/',
            'visi' => 'visi',
            'misi' => 'misi',
            'history' => 'sejarah',
            'demografi' => 'demografi',
            'geografi' => 'geografi',
        ]);

    }
}
