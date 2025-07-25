<?php

namespace App\Livewire\Tpa;

use Livewire\Component;
use App\Models\Ritasi;
use App\Models\RitasiKertawinangun;

class TabelHasilRitasi extends Component
{
    public $ritasiPecuk;
    public $ritasiKertawinangun;
    public $selectedTPA;

    public function mount()
    {
        $this->selectedTPA = 'pecuk';

        $this->ritasiPecuk = Ritasi::with('vehicle.driver')->latest()->get();
        $this->ritasiKertawinangun = RitasiKertawinangun::with('vehicle.driver')->latest()->get();
    }

    public function render()
    {
        return view('livewire.tpa.tabel-hasil-ritasi');
    }
}
