<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProgramSeeder::class,
            KategoriSeeder::class,
            KelasSeeder::class,
            MataKuliahSeeder::class,
            PertemuanSeeder::class,
            HakAksesDosenSeeder::class,
            KontenVideoSeeder::class,
            NilaiSeeder::class,
            // EnrollsSeeder::class,
            KontenDokumenSeeder::class,
            QuestionSeeder::class,
        ]);
    }
}
