<?php

namespace App\Livewire\Report;

use Livewire\Component;
use Livewire\Attributes;

class LaporanMingguan extends Component
{

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.report.laporan-mingguan');
    }
}
