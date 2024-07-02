<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Profile;
use App\Models\Slider;
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
            'icon' => 'assets/img/logo.png',
            'description' => 'Deskripsi Indramayu',
            'keywords' => 'opd indramayu, pemerintahan daerah Indramayu,informasi publik Indramayu,berita Indramayu terkini,layanan publik Indramayu',
            'tags' => 'OPD, Indramayu',
            'facebook' => 'https://www.facebook.com/diskominfo.indramayu',
            'youtube' => 'https://www.youtube.com/@diskominfoindramayu8327',
            'x' => 'https://twitter.com/indramayukab',
            'instagram' => 'https://www.instagram.com/diskominfoindramayu/',
            'visi' => 'Bersih, religius, maju',
            'misi' => '1. Mewujudkan Tata Kelola Pemerintahan Yang Melayani, Melindungi, Bersih, Bebas Korupsi,Kolusi.Nepotisme, Transparan, Akuntabel, Profesional Dandemokratis, Dengan 3 (Tiga) Program Prioritas, Yaitu : Peningkatan Sarana Dan Prasarana Aparatur, Peningkatan Kapasitas Sumber Daya Aparatur dan Pembinaan Dan Pengawasan Penyelenggaraan Pemerintahan Daerah.',
            'history' => 'Pendiri Indramayu Di daerah Bagelen Jawa Tengah yaitu di Banyu Urip tinggallah seorang Tumenggung Bernama Gagak Singalodra mempunyai lima orang putra, yaitu Raden Wangsanegara, Raden Ayu Wangsayuda, Raden Bagus Arya Wiralodra, Raden Bagus Tanujaya dan Raden Bagus Tanujiwa. Raden Bagus Wiralodra Putra ketiga yang berjiwa besar dan bercita-cita luhur, ia ingin membangun suatu Negara untuk diwariskan kelak kepada anak cucunya dengan tempat tinggal yang makmur dan sejahtera rakyatnya.',
            'geografi' => 'Cakupan wilayah administrasi pemerintah Kabupaten Indramayu saat ini terdiri dari 31 Kecamatan,309 desa dan 8 kelurahan, dengan luas wilayah 204,011 ha atau 2.040.110 Km dengan panjang garis pantai 147 km yang membentang sepanjang pantai utara antara Cirebon-Subang, dengan banyaknya desa pantai 36 desa dari 11 kecamatan.',
            'demografi' => 'Pada tahun 2010 berdasarkan hasil registrasi penduduk jumlah penduduk Kabupaten Indramayu tercatat sebanyak 1.769.423 jiwa terdiri dari laki-laki 885.345 jiwa dan perempuan 884.078 jiwa dan pada tahun 2011 tercatat sebanyak 1.675.790 jiwa yang terdiri dari laki-laki 862.846 jiwa dan perempuan 812.944 jiwa dan pada tahun 2015 tercatat sebanyak 1.823.757 jiwa yang terdiri dari laki-laki 924.375 jiwa dan perempuan 899.382 jiwa',
        ]);

        Slider::create([
            'title' => 'Kabupaten Indramayu',
            'description' => 'Deskripsi Indramayu',
            'type' => 'image',
            'location' => 'assets/img/slider1.jpg',
        ]);

        Menu::insert([
            [
                'title' => 'Beranda',
                'Description' => 'Halaman Utama',
                'url' => '/',
                'status' => 'active',
                'created_at' => now()
            ],
            [
                'title' => 'Artikel',
                'Description' => 'Halaman List Artikel',
                'url' => '/article',
                'status' => 'active',
                'created_at' => now()
            ],
            [
                'title' => 'Dokumen',
                'Description' => 'Halaman List Dokumen',
                'url' => '/dokumen',
                'status' => 'active',
                'created_at' => now()
            ],
            [
                'title' => 'Tentang',
                'Description' => 'Halaman Tentang Aplikasi dan Profil',
                'url' => '/about',
                'status' => 'active',
                'created_at' => now()
            ],
            [
                'title' => 'Kontak',
                'Description' => 'Halaman Kontak Masukan',
                'url' => '/contact',
                'status' => 'active',
                'created_at' => now()
            ],
        ]);

    }
}
