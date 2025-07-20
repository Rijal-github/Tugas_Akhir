<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class ChangePassword extends Component
{
    public $no_hp;
    public $token;
    public $password;
    public $password_confirmation;
    public $showPassword = false;
    public $showPasswordConfirm = false;

    public function mount()
    {
        $this->no_hp = request()->query('no_hp');
        $this->token = request()->query('token');
    }

    public function resetPassword()
    {
        $this->validate([
            'password' => 'required|min:8|confirmed',
        ],
        [
            'password.required' => 'mohon masukkan password baru anda',
            'password_confirmation.required' => 'mohon konfirmasi password baru anda',
            'password.confirmed' => 'konfirmasi password tidak cocok',
        ]);

        // Validasi token
        $record = DB::table('password_resets_by_phone')
            ->where('no_hp', $this->no_hp)
            ->where('token', $this->token)
            ->where('created_at', '>=', now()->subMinutes(30)) // Token aktif 30 menit
            ->first();

        if (!$record) {
            session()->flash('message', 'Token tidak valid atau sudah kadaluarsa.');
            return;
        }

        // Ubah password user
        $user = User::where('no_hp', $this->no_hp)->first();

        if ($user) {
            $user->password = Hash::make($this->password);
            $user->remember_token = Str::random(60); // optional
            $user->save();

            // Hapus token setelah berhasil reset
            DB::table('password_resets_by_phone')->where('no_hp', $this->no_hp)->delete();

            session()->flash('message', 'Password berhasil diubah. Silakan login kembali.');

            return redirect()->route('login');
        }

        session()->flash('message', 'Pengguna tidak ditemukan.');
    }

    
    #[Attributes\Layout('layouts.geust.main')]
    public function render()
    {
        return view('livewire.auth.change-password');
    }
}
