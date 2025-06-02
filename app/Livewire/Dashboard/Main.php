<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Main extends Component
{
    public $userName;

    public function mount()
    {
        $this->userName = Auth::user()->name; // atau sesuai field nama di tabel user
    }

    #[Attributes\Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.main');
    }
}

