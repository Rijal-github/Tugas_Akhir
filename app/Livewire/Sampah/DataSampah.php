<?php

namespace App\Livewire\Sampah;

use Livewire\Component;
use Livewire\Attributes;

class DataSampah extends Component
{
    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.sampah.data-sampah');
    }
}
