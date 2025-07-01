<?php

namespace App\Livewire\Driver;
// use Illuminate\Support\Facades\Hash;
use App\Models\supir;

use Livewire\Component;
use Livewire\Attributes;

class DataDriver extends Component
{
    public $supirs;

    public function mount()
    {
        // $this->supirs = supir::all();
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.driver.data-driver');
    }
}
