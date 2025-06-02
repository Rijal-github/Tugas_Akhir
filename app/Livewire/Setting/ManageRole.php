<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\Attributes;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ManageRole extends Component
{

    use WithFileUploads;

    public $users;
    public $userId;
    public $avatar;
    public $role;
    public $email;
    public $name;
    public $addres;
    public $password;


    public $showModal = false;
    public $confirmDeleteOpen = false;
    public $showSuccess = false;
    public $successMessage = '';
    public $isEditMode = false;
    public $statusMessage;

    
    protected function rules()
    {
    $rules = [
        'role' => 'required',
        'email' => 'required|email',
        'name' => 'required',
        'addres' => 'required',
    ];

        if (!$this->isEditMode || $this->password) {
            $rules['password'] = 'nullable|min:8';
    }

        return $rules;
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
        $this->role = $user->role;
        $this->email = $user->email;
        $this->name = $user->name;
        $this->addres = $user->addres;
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
                'role' => $this->role,
                'email' => $this->email,
                'name' => $this->name,
                'addres' => $this->addres,
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
                'role' => $this->role,
                'email' => $this->email,
                'name' => $this->name,
                'addres' => $this->addres,
                'password' => Hash::make($this->password),
            ]);
        
        }

        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();
        }        

        $this->showSuccess = true;
        $this->successMessage = true;
        $this->closeModal();
        $this->mount();
    }

    public function mount()
    {
        $this->users = User::all(); // ambil semua user
    }

    public function confirmDelete($id)
    {
        $this->confirmDeleteOpen = true;
        $this->dispatch('confirmDelete', $id);
    }
    
    public function delete($id)
    {
        User::findOrFail($id)->delete();
        $this->confirmDeleteOpen = false;
        $this->mount();
    }

    public function cancelDelete()
    {
        $this->statusMessage = 'Profile cancel to deleted!';
        $this->closeModal();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->confirmDeleteOpen = false;
        // $this->showSuccess = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->userId = null;
        $this->avatar = null;
        $this->role = null;
        $this->email = null;
        $this->name = null;
        $this->addres = null;
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.setting.manage-role');
    }
}

    

    

