<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Uptd;

class UptdSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Uptd::insert([
            ['nama_uptd' => 'UPTD Indramayu', 'alamat_uptd' => 'Jl. Raya Indramayu No.1'],
            ['nama_uptd' => 'UPTD Jatibarang', 'alamat_uptd' => 'Jl. Raya Jatibarang No.2'],
            ['nama_uptd' => 'UPTD Karangampel', 'alamat_uptd' => 'Jl. Raya Karangampel No.3'],
        ]);
    }
}
