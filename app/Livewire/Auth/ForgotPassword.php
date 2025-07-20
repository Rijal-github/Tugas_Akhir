<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Route;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\User;

class ForgotPassword extends Component
{
    public $no_hp;

        public function submit()
    {
        $this->validate([
            'no_hp' => 'required',
        ]);

        // Cek apakah no_hp terdaftar
        $user = User::where('no_hp', $this->no_hp)->first();

        if (!$user) {
            return session()->flash('message', 'Nomor handphone tidak terdaftar.');
        }

        // Logic kirim email reset password
        session()->flash('message', 'Password reset link sent to your number phone.');
    }

    public function goBack()
    {
        return redirect()->route('login'); 
    }

    #[Attributes\Layout('layouts.geust.main')]
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
