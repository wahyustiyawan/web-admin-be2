<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MataKuliah::create([
            'id' => '1',
            'kode' => '1111',
            'judul' => 'Pengantar UMKM',
            'deskripsi' => 'Ini kelas kredit',
            'kategori_id' => '1',
            'kelas_id' => '1',
            'sks' => '2'
        ]);    
        
        MataKuliah::create([
            'id' => '2',
            'kode' => '1112',
            'judul' => 'Pengantar Kredit I',
            'deskripsi' => 'Ini kelas KREDIT',
            'kategori_id' => '1',
            'kelas_id' => '1',
            'sks' => '2'
        ]);   

        MataKuliah::create([
            'id' => '3',
            'kode' => '1113',
            'judul' => 'Pengantar Kredit II',
            'deskripsi' => 'Ini kelas collection',
            'kategori_id' => '1',
            'kelas_id' => '1',
            'sks' => '3'
        ]);  
    }
}

