<?php

namespace App\Livewire\Jadwal;

use Livewire\Component;
use Livewire\Attributes;

class Pengangkutan extends Component
{
    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.jadwal.pengangkutan');
    }
}
