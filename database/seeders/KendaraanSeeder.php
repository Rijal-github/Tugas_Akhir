<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kendaraan;

class KendaraanSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Kendaraan::insert([
           
            [
                'no_polisi' => 'B 5678 ABC',
                'jenis_kendaraan' => 'Amroll Truck',
                'kapasitas_angkutan' => 5000,
                'id_uptd' => 1
            ],
            [
                'no_polisi' => 'B 9876 DEF',
                'jenis_kendaraan' => 'Truk',
                'kapasitas_angkutan' => 3000,
                'id_uptd' => 2
            ],
            [
                'no_polisi' => 'B 4321 GHI',
                'jenis_kendaraan' => 'Dump Truk',
                'kapasitas_angkutan' => 1500,
                'id_uptd' => 3
            ],
        ]);
    }
}
