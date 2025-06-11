<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\Role;

class Roles extends Component
{
    public $name;
    public $roleId;
    public $isEdit = false;
    public $showModal = false;
    public $statusMessage;
    public $Message;

    protected $rules = [
        'name' => 'required|string|max:255'
    ];

    public function openCreateModal()
    {
        $this->reset(['name', 'roleId']);
        $this->isEdit = false;
        $this->showModal = true;
    }

    // public function save()
    // {
    //     $this->validate([
    //         'name' => 'required|unique:roles,name|max:50'
    //     ]);

    //     Role::create(['name' => $this->name]);
    //     $this->reset('name');
    //     $this->loadRoles();
    //     session()->flash('success', 'Role berhasil ditambahkan.');
    // }

    public function save()
    {
        $this->validate();

        Role::updateOrCreate(
            ['id_role' => $this->roleId],
            ['name' => $this->name]
        );

        $this->showModal = false;
        $this->reset(['name', 'roleId']);
    }

    public function openEditModal($id)
    {
        // Karena kolom ID-nya adalah 'id_role'
        $role = Role::where('id_role', $id)->firstOrFail();
    
        $this->roleId = $role->id_role; // ❗ pakai id_role, bukan id
        $this->name = $role->name;
        $this->isEdit = true;
        $this->showModal = true;
    }

    // public function update()
    // {
    //     $this->validate([
    //         'editName' => 'required|max:50|unique:roles,name,' . $this->editId,
    //     ]);

    //     $role = Role::findOrFail($this->editId);
    //     $role->update(['name' => $this->editName]);

    //     $this->reset('editId', 'editName');
    //     $this->loadRoles();
    //     session()->flash('success', 'Role berhasil diperbarui.');
    // }

    // public function prepareDelete($id)
    // {
    //     $this->deleteId = $id;
    // }

    public function delete($id)
    {
        Role::findOrFail($id)->delete();
    }


    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        $roles = Role::latest()->get();
        return view('livewire.setting.roles', compact('roles'));
    }
}
