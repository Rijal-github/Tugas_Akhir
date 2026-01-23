<?php

namespace App\Livewire\Driver;

use Livewire\Component;
use Livewire\Attributes;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicle;
use App\Models\BuktiTransaksi;
use App\Models\User;

class DataDriver extends Component
{
    public $vehicles;
    public $transaksis =[];
    // public $driverData = null;
    public $selectedDriverId = null;
     public $selectedDriver = null;

    public function mount()
    {
        $this->vehicles = Vehicle::with(['driver.role', 'uptd'])
        ->whereHas('driver', fn($q) => $q->where('id_role', 5))
        ->whereNotNull('id_uptd')
        ->get();

        $this->selectedDriver = null;
        $this->transaksis = collect(); // kosong
    }

    public function showDriver($driverId)
    {
        // Ambil vehicle + driver yg dipilih
        $vehicle = Vehicle::with(['driver', 'transaksis.operator'])
            ->where('id_driver', $driverId)
            ->first();

        if (!$vehicle) {
            $this->selectedDriverId = null;
            $this->selectedDriver = null;
            $this->transaksis = collect();
            return;
        }

        $this->selectedDriverId = $driverId;
        $this->selectedDriver   = $vehicle->driver;

        // Ambil semua transaksi berdasarkan kendaraan driver
       $this->transaksis = BuktiTransaksi::with(['operator', 'vehicle'])
            ->latest()
            ->take(5)
            ->get();
        // $this->selectedDriverId = $driverId;

        // $this->transaksis = BuktiTransaksi::with(['operator', 'vehicle.driver'])
        //     ->whereHas('vehicle', function ($q) use ($driverId) {
        //         $q->where('id_driver', $driverId);
        //     })
        //     ->whereIn('id', function ($q) {
        //         $q->select(DB::raw('MAX(id)'))
        //             ->from('bukti_transaksis')
        //             ->groupBy('id_vehicle');
        //     })
        //     ->get();
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.driver.data-driver', [
            'transaksis' => $this->transaksis,
            'selectedDriver' => $this->selectedDriver,
        ]);
    }
}

   // $this->transaksis = BuktiTransaksi::with(['operator', 'vehicle'])
        //     ->latest()
        //     ->take(5)
        //     ->get();
