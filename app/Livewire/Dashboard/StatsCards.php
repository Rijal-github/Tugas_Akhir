<?php

namespace App\Livewire\Dashboard;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Tps;

class StatsCards extends Component
{

    public $kontainer;
    public $beratap;
    public $tpsKecil;

    public function mount()
    {
    $data = Tps::select('jenis_tps', DB::raw('COUNT(*) as total'))
        ->groupBy('jenis_tps')
        ->pluck('total', 'jenis_tps');

    $this->kontainer = $data['Landasan Kontainer'] ?? 0;
    $this->beratap   = $data['Landasan Beratap'] ?? 0;
    $this->tpsKecil  = $data['TPS Kecil'] ?? 0;


    }
    public function render()
    {
        return view('livewire.dashboard.stats-cards');
    }
}
