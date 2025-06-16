<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Role;
use App\Models\Uptd;

class KendaraanSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ambil semua user yang memiliki role 'driver'
        $driverRole = Role::where('name', 'driver')->first();

        if (!$driverRole) {
            $this->command->error("Role 'driver' tidak ditemukan.");
            return;
        }
    
        $drivers = User::where('id_role', $driverRole->id_role)->get();
    
        if ($drivers->count() < 3) {
            $this->command->warn('Jumlah driver kurang dari 3, data kendaraan mungkin tidak lengkap.');
        }
    
        $driverIds = $drivers->pluck('id')->values();
    
        // $uptds = Uptd::all();
    
        // if ($uptds->count() < 3) {
        //     $this->command->warn('Jumlah UPTD kurang dari 3, data kendaraan mungkin tidak lengkap.');
        // }
    
        // $uptdIds = $uptds->pluck('id_uptd')->values();
    
        Vehicle::insert([
            [
                'no_polisi' => 'B 5678 ABC',
                'jenis_kendaraan' => 'Amroll Truck',
                'kapasitas_angkutan' => 5000,
                'id_uptd' => 2,
                'id_driver' => $driverIds->get(0),
            ],
            [
                'no_polisi' => 'B 9876 DEF',
                'jenis_kendaraan' => 'Truk',
                'kapasitas_angkutan' => 3000,
                'id_uptd' => 3,
                'id_driver' => $driverIds->get(1),
            ],
            [
                'no_polisi' => 'B 4321 GHI',
                'jenis_kendaraan' => 'Dump Truk',
                'kapasitas_angkutan' => 1500,
                'id_uptd' => 4,
                'id_driver' => $driverIds->get(2),
            ],
        ]);

        // $vehicles = [];

        // for ($i = 0; $i < count($kendaraanList); $i++) {
        //     $vehicles[] = [
        //         'no_polisi' => $kendaraanList[$i]['no_polisi'],
        //         'jenis_kendaraan' => $kendaraanList[$i]['jenis_kendaraan'],
        //         'kapasitas_angkutan' => $kendaraanList[$i]['kapasitas_angkutan'],
        //         'id_driver' => $driverIds->get($i) ?? $driverIds->first(),
        //         'id_uptd' => $uptdIds->get($i, 1),
        //     ];
        // }

        // Vehicle::insert($vehicles);

    }
}
