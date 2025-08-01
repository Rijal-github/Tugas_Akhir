<?php

namespace App\Livewire\Driver;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\Vehicle;
use App\Models\BuktiTransaksi;

class DataDriver extends Component
{
    public $vehicles;
    public $transaksis;

    public function mount()
    {
        $this->vehicles = Vehicle::with(['driver.role', 'uptd'])
        ->whereHas('driver', fn($q) => $q->where('id_role', 5))
        ->whereNotNull('id_uptd')
        ->get();

        $this->transaksis = BuktiTransaksi::with(['operator', 'vehicle'])
            ->latest()
            ->take(5)
            ->get();
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.driver.data-driver', [
            'transaksis' => $this->transaksis,
        ]);
    }
}
