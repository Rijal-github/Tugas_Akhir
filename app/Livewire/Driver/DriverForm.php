<?php

namespace App\Livewire\Driver;
use Illuminate\Support\Facades\Hash;
use App\Models\supir;

use Livewire\Component;
use Livewire\Attributes;

class DriverForm extends Component
{
    public $showModal = false;
    public $showEdit = false;

    public $nama_supir, $password, $email, $no_hp;

    protected $rules = [
        'nama_supir' => 'required|string|max:100',
        'password' => 'required|min:8',
        'email' => 'required|email|unique:supirs,email',
        'no_hp' => 'required|string|max:20',
    ];

    public function openModal()
    {
        $this->resetForm();
        $this->showEdit = false;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        supir::create([
            'nama_supir' => $this->nama_supir,
            'password' => Hash::make($this->password),
            'email' => $this->email,
            'no_hp' => $this->no_hp,
        ]);

        $this->resetForm(); // reset form input
        $this->closeModal();
        $this->dispatch('show-success-message'); // bisa dipakai untuk hide modal
    }

    public function closeModal()
    {
        $this->showModal = false;
        // $this->confirmDeleteOpen = false;
        // $this->showSuccess = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->nama_supir = null;
        $this->password = null;
        $this->email = null;
        $this->no_hp = null;
    }


    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.driver.driver-form');
    }
}
