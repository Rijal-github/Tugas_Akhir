<?php

namespace App\Livewire\Driver;
// use Illuminate\Support\Facades\Hash;
use App\Models\supir;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\Vehicle;

class DataDriver extends Component
{
    public $vehicles;

    public function mount()
    {
        $this->vehicles = Vehicle::with(['driver.role', 'uptd'])
        ->whereHas('driver', fn($q) => $q->where('id_role', 5))
        ->whereNotNull('id_uptd')
        ->get();
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.driver.data-driver');
    }
}
