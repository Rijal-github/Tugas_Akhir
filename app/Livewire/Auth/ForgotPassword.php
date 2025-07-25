<?php

namespace App\Livewire\Auth;
use Illuminate\Support\Facades\Route;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgotPassword extends Component
{
    public string $email = '';
    public string $message = '';

    public function submit()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->where('email', $this->email)->delete();

        DB::table('password_reset_tokens')->insert([
            'email' => $this->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        Mail::send('emails.reset-password', [
            'token' => $token,
            'email' => $this->email
        ], function ($message) {
            $message->to($this->email);
            $message->subject('Reset Password');
        });

        $this->message = 'Link reset password sudah dikirim ke email kamu.';
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

// public $no_hp;

//     public function submit()
// {
//     $this->validate([
//         'no_hp' => 'required',
//     ]);

//     // Cek apakah no_hp terdaftar
//     $user = User::where('no_hp', $this->no_hp)->first();

//     if (!$user) {
//         return session()->flash('message', 'Nomor handphone tidak terdaftar.');
//     }

//     // Logic kirim email reset password
//     session()->flash('message', 'Password reset link sent to your number phone.');
// }