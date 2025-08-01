<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes;
use App\Models\User;

class ViewProfile extends Component
{
    use WithFileUploads;
    public $username;
    public $name;
    public $avatar;
    public $email;
    public $no_hp;
    public $alamat_user;
    public $isEditing = false;
    public string $successMessage = '';

    public function mount()
    {
        $user = Auth::user();
        $this->username = $user->username;
        $this->email = $user->email;
        $this->no_hp = $user->no_hp;
        $this->name = $user->name;
        $this->alamat_user = $user->alamat_user;
    }
    public function toggleEdit()
    {
        $this->isEditing = !$this->isEditing;
    }

    public function save()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required|string|max:20',
            'alamat_user' => 'required|string',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user = User::find(Auth::id());

        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->avatar = $avatarPath;
        }

        $user->name = $this->name;
        $user->email = $this->email;
        $user->no_hp = $this->no_hp;
        $user->alamat_user = $this->alamat_user;
        $user->save();


        $this->isEditing = false;

        $this->successMessage = 'Profil berhasil diperbarui.';
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.profile.view-profile');
    }
}
