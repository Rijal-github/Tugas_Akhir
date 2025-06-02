<?php

namespace App\Livewire\Iot;

use Livewire\Component;
use Livewire\Attributes;

class DataIot extends Component
{
    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.iot.data-iot');
    }
}
