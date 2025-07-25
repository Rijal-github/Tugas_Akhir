<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\Role;

class Roles extends Component
{
    public $name;
    public $ranah;
    public $roleId;
    public $isEdit = false;
    public $showModal = false;

    public $konfirmDelete = false;
    public bool $showSuccess = false;
    public string $successMessage = '';

    public $konfirmDeleteId = null;
    public $isUpdate = false;

    protected $rules = [
        'name' => 'required|string|max:255'
    ];

    public function showSuccessMessage(string $message): void
    {
        $this->showSuccess = true;
        $this->successMessage = $message;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'ranah' => 'required|string',
        ]);

        Role::updateOrCreate(
            ['id' => $this->roleId],
            ['name' => $this->name,
                     'ranah' =>$this->ranah,               
                    ]
        );

        $message = $this->roleId ? 'Data role berhasil diperbarui.' : 'Data role berhasil disimpan.';

        $this->resetForms();
        $this->showModal = false;
        $this->showSuccessMessage($message);
    }


    public function openEditModal($id)
    {
        $role = Role::findOrFail($id);
    
        $this->roleId = $role->id_role;
        $this->name = $role->name;
        $this->isEdit = true;
        $this->showModal = true;
    }

    public function openDelete($id)
    {
        $this->konfirmDelete = true;
        $this->konfirmDeleteId = $id;
    }

    public function Delete()
    {
        if ($this->konfirmDeleteId) {
            Role::find($this->konfirmDeleteId)?->delete();
            $this->konfirmDelete = false;
            $this->konfirmDeleteId = null;
            $this->showSuccessMessage('Data berhasil dihapus.');
        }
    }

    public function resetForms()
    {
        $this->name = '';
        $this->ranah = '';
        $this->showModal = false;
        $this->isEdit = false;
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        $roles = Role::latest()->get();
        return view('livewire.setting.roles', compact('roles'));
    }
}

    // public function openCreateModal()
    // {
    //     $this->reset(['name', 'roleId']);
    //     $this->isEdit = false;
    //     $this->showModal = true;
    // }

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

    // public function save()
    // {
    //     $this->validate();

    //     Role::updateOrCreate(
    //         ['id_role' => $this->roleId],
    //         ['name' => $this->name]
    //     );

    //     $this->showModal = false;
    //     $this->reset(['name', 'roleId']);
    // }

    
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

    // public function delete($id)
    // {
    //     Role::findOrFail($id)->delete();
    // }


