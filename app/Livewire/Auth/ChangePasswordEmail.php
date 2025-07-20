<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class ChangePasswordEmail extends Component
{
    public $email;
    public $token;
    public $password;
    public $password_confirmation;
    public $showPassword = false;
    public $showPasswordConfirm = false;

    public function mount()
    {
        $this->email = request()->query('email');
        $this->token = request()->query('token');
    }

    public function resetPassword()
    {
        $this->validate([
            'password' => 'required|min:8|confirmed',
        ], [
            'password.required' => 'mohon masukkan password baru anda',
            'password.confirmed' => 'konfirmasi password tidak cocok',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $this->email)
            ->where('token', $this->token)
            ->where('created_at', '>=', now()->subMinutes(30))
            ->first();

        if (!$record) {
            session()->flash('message', 'Token tidak valid atau sudah kadaluarsa.');
            return;
        }

        $user = User::where('email', $this->email)->first();

        if ($user) {
            $user->password = Hash::make($this->password);
            $user->remember_token = Str::random(60);
            $user->save();

            DB::table('password_reset_tokens')->where('email', $this->email)->delete();

            session()->flash('message', 'Password berhasil diubah. Silakan login kembali.');
            return redirect()->route('login');
        }

        session()->flash('message', 'Pengguna tidak ditemukan.');
    }

    #[Attributes\Layout('layouts.geust.main')]
    public function render()
    {
        return view('livewire.auth.change-password-email');
    }
}
