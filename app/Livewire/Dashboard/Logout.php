<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public $showConfirm = false;

    public function confirmLogout()
    {
        $this->showConfirm = true;
    }

    public function cancelLogout()
    {
        $this->showConfirm = false;
    }
    
    public function logout()
    {
        Auth::logout(); // atau auth()->logout()

        session()->invalidate(); // menghapus session
        session()->regenerateToken(); // regenerasi token CSRF

        return redirect('/'); // arahkan ke halaman login
    }

    public function render()
    {
        return view('livewire.dashboard.logout');
    }
}
