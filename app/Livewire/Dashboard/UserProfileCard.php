<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class UserProfileCard extends Component
{

    public $userName;
    public $addres;


    public function mount()
    {
        $user = Auth::user();
        $this->userName = $user->name;
        $this->addres = $user->addres ?? 'Belum diisi';
    }

    public function render()
    {
        return view('livewire.dashboard.user-profile-card');
    }
}
