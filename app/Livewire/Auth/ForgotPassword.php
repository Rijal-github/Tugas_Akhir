<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Route;

use Livewire\Component;
use Livewire\Attributes;

class ForgotPassword extends Component
{
    public $no_hp;

        public function submit()
    {
        $this->validate([
            'no_hp' => 'required',
        ]);

        // Logic kirim email reset password
        session()->flash('message', 'Password reset link sent to your number phone.');
    }

    public function goBack()
    {
        return redirect()->route('login'); // Pastikan route('login') sudah ada
    }

    #[Attributes\Layout('layouts.geust.main')]
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
