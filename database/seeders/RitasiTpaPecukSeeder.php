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
                'id_vehicle'     => $vehicle->id,
                'banyak_ritasi' => rand(1, 5),
                'bruto'     => rand(4000, 8000),
                'netto'    => rand(3000, 5000),
                'keterangan'    => 'Sampah Liar',
                
            ]);
            
        }
    }
}
