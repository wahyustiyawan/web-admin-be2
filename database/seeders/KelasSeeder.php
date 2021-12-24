<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kelas::create([
            'id' => '1',
            'nama' => 'Credit',
            'deskripsi' => 'Ini program studi kredit',
            //'kategori_id' => '1'
        ]);    
        
        Kelas::create([
            'id' => '2',
            'nama' => 'Sales',
            'deskripsi' => 'Ini program studi sales',
            //'kategori_id' => '1'
        ]);   

        Kelas::create([
            'id' => '3',
            'nama' => 'Collection',
            'deskripsi' => 'Ini program studi collection',
        ]); 
        
        Kelas::create([
            'id' => '4',
            'nama' => 'Manajemen operasional & kualitas',
            'deskripsi' => 'Ini program studi Manajemen operasional & kualitas',
        ]);  

        Kelas::create([
            'id' => '5',
            'nama' => 'Logistik & supply chain',
            'deskripsi' => 'Ini program studi Logistik & supply chain',
        ]);  

        Kelas::create([
            'id' => '6',
            'nama' => 'Ekspor & Impor',
            'deskripsi' => 'Ini program studi Ekspor & Impor',
        ]);  

        Kelas::create([
            'id' => '7',
            'nama' => 'Cyber Security',
            'deskripsi' => 'Ini program studi Cyber Security',
        ]);  

        Kelas::create([
            'id' => '8',
            'nama' => 'Block Chain',
            'deskripsi' => 'Ini program studi Block Chain',
        ]);  

        Kelas::create([
            'id' => '9',
            'nama' => 'Big Data',
            'deskripsi' => 'Ini program studi Big Data',
        ]);  


        Kelas::create([
            'id' => '10',
            'nama' => 'AI & Algorithm',
            'deskripsi' => 'Ini program studi AI & Algorithm',
        ]);  

        Kelas::create([
            'id' => '11',
            'nama' => 'CSC',
            'deskripsi' => 'Ini program studi CSC',
        ]);  

        Kelas::create([
            'id' => '12',
            'nama' => 'Flutter',
            'deskripsi' => 'Ini program studi Flutter',
        ]);  

        Kelas::create([
            'id' => '13',
            'nama' => 'Firebase & MySQL',
            'deskripsi' => 'Ini program studi Firebase & MySQL',
        ]);  

        Kelas::create([
            'id' => '14',
            'nama' => 'Web Development',
            'deskripsi' => 'Ini program studi Web Development',
        ]);  

        Kelas::create([
            'id' => '15',
            'nama' => 'REST API',
            'deskripsi' => 'Ini program studi REST API',
        ]);  

        Kelas::create([
            'id' => '16',
            'nama' => 'Backend Laravel',
            'deskripsi' => 'Ini program studi Backend Laravel',
        ]);  

        Kelas::create([
            'id' => '17',
            'nama' => 'Digital Marketing ',
            'deskripsi' => 'Ini program studi Digital Marketing',
        ]);  

        Kelas::create([
            'id' => '18',
            'nama' => 'Digital Research',
            'deskripsi' => 'Ini program studi Digital Research',
        ]);  

        Kelas::create([
            'id' => '19',
            'nama' => 'Digital Outreach',
            'deskripsi' => 'Ini program studi Digital Outreach',
        ]);  

        Kelas::create([
            'id' => '20',
            'nama' => 'VR & AR',
            'deskripsi' => 'Ini program studi VR & AR',
        ]);  

        Kelas::create([
            'id' => '21',
            'nama' => 'Streamer, Podcast & Youtuber Academy',
            'deskripsi' => 'Ini program studi Streamer, Podcast & Youtuber Academy',
        ]);  
    }
}

