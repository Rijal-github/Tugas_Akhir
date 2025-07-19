<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\Attributes;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ManageRole extends Component
{

    use WithFileUploads;

    public $users;
    public $userId;
    public $avatar;
    public $email;
    public $username;
    public $no_hp;
    public $name;
    public $alamat_user;
    public $password;
    public $roles;  // untuk simpan data role dari DB
    public $role;   // untuk menyimpan role yang dipilih di form

    public $confirmDeleteId = null;

    public $showModal = false;
    public $confirmDelete = false;
    public $showSuccess = false;
    public $successMessage = '';
    public $isEditMode = false;
    // public $statusMessage;

    
    protected function rules()
    {
    $rules = [
        'role' => 'required|exists:roles,id',
        'email' => 'required|email',
        'name' => 'required',
        'username' => 'required|string|alpha_dash|unique:users,username,' . $this->userId,
        'alamat_user' => 'required',
    ];

        if (!$this->isEditMode || $this->password) {
            $rules['password'] = 'nullable|min:8';
    }

        return $rules;
    }

    public function showSuccessMessages(string $message): void
    {
        $this->showSuccess = true;
        $this->successMessage = $message;
        // Tambahkan logika untuk menyembunyikan popup setelah beberapa detik, jika diperlukan.
        // Misalnya, menggunakan JavaScript atau metode Livewire.
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isEditMode = false;
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        $user = User::findOrFail($id);

        $this->userId = $user->id;
        $this->role = $user->id_role;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->no_hp = $user->no_hp;
        $this->name = $user->name;
        $this->alamat_user = $user->alamat_user;
        $this->avatar = null;
        $this->password = null;

        $this->isEditMode = true;
        $this->showModal = true;
    }

    public function save()
    {

        $this->validate();

        if ($this->isEditMode) {
            $user = User::findOrFail($this->userId);
            $data = [
                'id_role' => $this->role,
                'email' => $this->email,
                'username' => $this->username,
                'no_hp' => $this->no_hp,
                'name' => $this->name,
                'alamat_user' => $this->alamat_user,
            ];

            if ($this->password) {
                $data['password'] = Hash::make($this->password);
            }

            $user->update($data);

        } else {

            if (!$this->password) {
                session()->flash('error', 'Password is required.');
                return;
            }

            $user = User::create([
                'id_role' => $this->role,
                'email' => $this->email,
                'username' => $this->username,
                'no_hp' => $this->no_hp,
                'name' => $this->name,
                'alamat_user' => $this->alamat_user,
                'password' => Hash::make($this->password),
            ]);
        
        }

        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();
        }        

        $message = $this->userId ? 'Data berhasil diperbaharui.' : 'Data berhasil disimpan.';
        $this->closeModal();
        $this->mount();

        $this->showSuccessMessages($message);
    }

    public function mount()
    {
        $this->users = User::all(); // ambil semua user
        $this->roles = Role::all(); // ambil semua role dari DB

        // logger($this->roles); // log isi roles ke laravel.log
    }

    public function confirmDeleted($id)
    {
        $this->confirmDelete = true;
        $this->confirmDeleteId = $id;
        // $this->confirmDelete = true;
        // $this->dispatch('confirmDelete', $id);
    }
    
    public function deleted()
    {
        if ($this->confirmDeleteId) {
            User::find($this->confirmDeleteId)?->delete();
            $this->confirmDelete = false;
            $this->confirmDeleteId = null;
            $this->showSuccessMessages('Data berhasil dihapus.');
        }
        // User::findOrFail($id)->delete();
        // $this->confirmDelete = false;
        // $this->mount();
    }

    public function cancelDelete()
    {
        // $this->statusMessage = 'Profile cancel to deleted!';
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->confirmDelete = false;
        // $this->showSuccess = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->avatar = null;
        $this->role = null;
        $this->email = null;
        $this->username = null;
        $this->no_hp = null;
        $this->name = null;
        $this->alamat_user = null;
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.setting.manage-role');
    }
}

    

    

