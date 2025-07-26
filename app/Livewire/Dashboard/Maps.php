<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Tps;

class Maps extends Component
{
    public $lokasiList;

    public function mount()
    {
        $this->lokasiList = Tps::select('latitude', 'longitude', 'lokasi')->get();
    }
    public function render()
    {
        return view('livewire.dashboard.maps');
    }
}
