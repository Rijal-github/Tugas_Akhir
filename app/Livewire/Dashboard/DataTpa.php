<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Uptd;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;

class DataTpa extends Component
{
    public $uptdVehicles;
    public $vehicleCountPerUptd;

    public function mount()
{
    // Ambil semua UPTD beserta kendaraan yang dimiliki (misalnya ambil 3 dulu)
    // $this->uptdVehicles = Uptd::with('vehicles')->take(3)->get();

    // Hitung jumlah kendaraan per jenis per UPTD
    $this->vehicleCountPerUptd = DB::table('vehicle')
    ->join('uptd', 'vehicle.id_uptd', '=', 'uptd.id_uptd')
    ->select(
        'vehicle.id_uptd',
        'uptd.nama_uptd',
        'vehicle.jenis_kendaraan',
        DB::raw('COUNT(vehicle.id) as total_kendaraan')
    )
    ->groupBy('vehicle.id_uptd', 'uptd.nama_uptd', 'vehicle.jenis_kendaraan')
    ->orderByDesc('total_kendaraan')
    ->get();

    $this->uptdVehicles = Uptd::with('vehicles')
    ->whereIn('id_uptd', $this->vehicleCountPerUptd->pluck('id_uptd')->unique())
    ->get()
    ->take(3);
}
    public function render()
    {
        return view('livewire.dashboard.data-tpa');
    }
}
