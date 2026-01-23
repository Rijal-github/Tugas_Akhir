<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Ritasi;
use App\Models\RitasiKertawinangun;

class RitasiChart extends Component
{
    public $pecuk = [];
    public $kertawinangun = []; 

    public function mount()
    {

        $pecukData = array_fill(0, 12, 0);
        foreach (Ritasi::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(netto) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get() as $row) {
            $pecukData[$row->month - 1] = $row->total; // index mulai dari 0
        }
        $this->pecuk = $pecukData;

      $kertawinangunData = array_fill(0, 12, 0);
        foreach (RitasiKertawinangun::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(netto) as total'))
            ->groupBy('month')
            ->orderBy('month')
            ->get() as $row) {
            $kertawinangunData[$row->month - 1] = $row->total; // index mulai dari 0
        }
        $this->kertawinangun = $kertawinangunData;

        //  dd($this->pecuk, $this->kertawinangun);

        // $this->pecuk = [];
        // $this->kertawinangun = [];

        // for ($i = 1; $i <= 12; $i++) {
        //     $this->pecuk[] = $pecuk[$i] ?? 0;
        //     $this->kertawinangun[] = $kertawinangun[$i] ?? 0;
        // }
    }
    public function render()
    {
        return view('livewire.dashboard.ritasi-chart');
    }
}
