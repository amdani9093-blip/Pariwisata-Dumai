<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Destinasi;

class DestinasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Destinasi::truncate();
 
    Destinasi::create([
        'nama' => 'Pantai Teluk Makmur',
        'deskripsi' => 'Pantai dengan suasana tenang, cocok untuk menikmati sore bersama keluarga.',
        'gambar' => 'Pantai Teluk Makmur.jpg',
        'jam_buka' => '09:00:00',
        'jam_tutup' => '18:00:00',
        'lokasi' => 'Teluk Makmur,Medang Kampai',
    ]);
 

   
 
    Destinasi::create([
        'nama' => 'Bukit Gelanggang',
        'deskripsi' => 'Ruang terbuka hijau yang menjadi pusat aktivitas masyarakat Dumai..',
        'gambar' => 'Bukit Gelanggang.jpg',
        'jam_buka' => '06:00:00',
        'jam_tutup' => '21:00:00',
        'lokasi' => 'Bintan,Dumai Tumur',
    ]);

 
 
    Destinasi::create([
        'nama' => 'dumai islamic center',
        'deskripsi' => 'Salah satu destinasi wisata islami di kota dumai yang sangat banayk peminat dari luar daerah maupun warga setempat.',
        'gambar' => 'dumai islamic center.jpg',
        'jam_buka' => '07:00:00',
        'jam_tutup' => '23:59:00',
        'lokasi' => 'Bintan,Dumai Timur',
    ]);
    // ...destinasi lainnya (Tangsi Belanda, Skywalk Tengku Buwang Asmara, dst)
}
}