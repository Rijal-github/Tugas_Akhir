<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class Register extends Component
{
    // ----- Protected
    protected $uuidUser;
    protected $username = '';
    public function render()
    {
        return view('livewire.auth.register');
    }
}
