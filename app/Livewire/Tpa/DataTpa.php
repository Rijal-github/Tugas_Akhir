<?php

namespace App\Livewire\Tpa;

use Livewire\Component;
use Livewire\Attributes;

class DataTpa extends Component
{
    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.tpa.data-tpa');
    }
}
