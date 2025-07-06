<?php

namespace App\Livewire\Report;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\Ritasi;
use Carbon\Carbon;

class Pelaporan extends Component
{

    public $tanggal;

    public function mount()
    {
        $this->tanggal = Carbon::now()->format('Y-m-d');
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        $data = Ritasi::whereDate('created_at', $this->tanggal)->get();

        $total_ritasi = $data->sum('banyak_ritasi');
        $total_netto = $data->sum(function ($item) {
            return $item->netto_post - $item->netto_pre;
        });

        return view('livewire.report.pelaporan', [
            'ritasi' => $data,
            'total_ritasi' => $total_ritasi,
            'total_netto' => $total_netto,
        ]);

    }
    // public function render()
    // {
    //     return view('livewire.report.pelaporan');
    // }
}
