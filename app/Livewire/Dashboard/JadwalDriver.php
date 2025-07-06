<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Vehicle;
use App\Models\User;

class JadwalDriver extends Component
{
    public $vehicles;
    public $driverPerVehicleType;

    public function mount()
    {
        // Ambil 3 kendaraan dengan driver yang memiliki role driver (misalnya id_role = 3)
        $this->vehicles = Vehicle::with(['driver' => function ($query) {
            $query->where('id_role', 5);
        }])->whereHas('driver', function ($query) {
            $query->where('id_role', 5);
        })->take(3)->get();

        // Hitung jumlah supir unik untuk tiap jenis kendaraan
        $this->driverPerVehicleType = DB::table('vehicle')
        ->join('users', 'vehicle.id_driver', '=', 'users.id')
        ->select('vehicle.jenis_kendaraan', DB::raw('COUNT(DISTINCT vehicle.id_driver) as total_driver'))
        ->where('users.id_role', 5)
        ->groupBy('vehicle.jenis_kendaraan')
        ->get();
    }
    public function render()
    {
        return view('livewire.dashboard.jadwal-driver');
    }
}
