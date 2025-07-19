<?php

namespace App\Livewire\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes;

class ViewProfile extends Component
{
    public $username;
    public $name;
    public $email;
    public $no_hp;
    // public $birth_date;
    public $alamat_user;

    public function mount()
    {
        $user = Auth::user();
        $this->username = $user->username;
        $this->email = $user->email;
        $this->no_hp = $user->no_hp;
        $this->name = $user->name;
        // $this->birth_date = $user->birth_date;
        $this->alamat_user = $user->alamat_user;
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.profile.view-profile');
    }
}
