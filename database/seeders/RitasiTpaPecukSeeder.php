<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ritasi;
use App\Models\Vehicle;

class RitasiTpaPecukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehiclesWithDrivers = Vehicle::with('driver')->get();

        foreach ($vehiclesWithDrivers as $vehicle) {
            Ritasi::create([
                'id_driver'     => $vehicle->id_driver,
                'banyak_ritasi' => rand(1, 5),
                'netto_pre'     => rand(1000, 3000),
                'netto_post'    => rand(3000, 6000),
                'keterangan'    => 'Ritasi untuk kendaraan ' . $vehicle->no_polisi,
            ]);
        }
    }
}
