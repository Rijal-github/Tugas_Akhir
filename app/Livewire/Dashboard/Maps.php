<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Lokasi;

class Maps extends Component
{
    public $lokasiList;

    public function mount()
    {
        // $this->lokasiList = Lokasi::select('latitude', 'longitude', 'nama_lokasi')->get();
    }
    public function render()
    {
        return view('livewire.dashboard.maps');
    }
}
