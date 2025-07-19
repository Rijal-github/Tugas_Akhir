<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tps')->insert([
            [
                'created_by' => 1,
                'id_uptd' => 1,
                'nama' => 'TPS Contoh 1',
                'tahun' => '2024',
                'jenis_tps' => 'Landasan Kontainer',
                'lokasi' => 'Jl. Linggajati No. 1',
                'latitude' => -6.200000,
                'longitude' => 106.816666,
                'keterangan' => 'TPS untuk wilayah A.',
                'foto_tps' => 'tps1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'created_by' => 1,
                'id_uptd' => 2,
                'nama' => 'TPS Contoh 2',
                'tahun' => '2023',
                'jenis_tps' => 'Landasan Beratap',
                'lokasi' => 'Jl. Cidempet No. 2',
                'latitude' => -6.210000,
                'longitude' => 106.826666,
                'keterangan' => 'TPS untuk wilayah B.',
                'foto_tps' => 'tps2.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
