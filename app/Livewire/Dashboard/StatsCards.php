<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Tps;

class StatsCards extends Component
{

    public $kontainer;
    public $beratap;
    public $tpsKecil;

    public function mount()
    {
        // $this->kontainer = Tps::where('jenis_tps', 'Landasan Kontainer')->sum('jumlah');
        // $this->beratap = Tps::where('jenis_tps', 'Landasan Beratap')->sum('jumlah');
        // $this->tpsKecil = Tps::where('jenis_tps', 'TPS Kecil')->sum('jumlah');
    }
    public function render()
    {
        return view('livewire.dashboard.stats-cards');
    }
}
