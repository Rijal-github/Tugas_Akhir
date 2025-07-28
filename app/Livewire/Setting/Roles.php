<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\Role;
use App\Models\Permission;

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
    public $selectedPermissions = [];
    public $allPermissions = [];

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

        $role = Role::updateOrCreate(
            ['id' => $this->roleId],
            ['name' => $this->name, 'ranah' => $this->ranah]
        );

        // Sinkronisasi permission
        $role->permissions()->delete();

        // Simpan permission baru
        if ($this->ranah === 'Website') {
            foreach ($this->selectedPermissions as $permissionName) {
                Permission::create([
                    'akses' => $permissionName,
                    'id_role' => $role->id,
                ]);
            }
        }

        $message = $this->roleId ? 'Data role berhasil diperbarui.' : 'Data role berhasil disimpan.';
        $this->resetForms();
        $this->showModal = false;
        $this->showSuccessMessage($message);
        // $this->validate([
        //     'name' => 'required|string|max:255',
        //     'ranah' => 'required|string',
        // ]);

        // Role::updateOrCreate(
        //     ['id' => $this->roleId],
        //     ['name' => $this->name,
        //              'ranah' =>$this->ranah,               
        //             ]
        // );

        // $message = $this->roleId ? 'Data role berhasil diperbarui.' : 'Data role berhasil disimpan.';

        // $this->resetForms();
        // $this->showModal = false;
        // $this->showSuccessMessage($message);
    }


    public function openEditModal($id)
    {
        $role = Role::with('permissions')->findOrFail($id);

        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->ranah = $role->ranah;
        $this->selectedPermissions = $role->permissions->pluck('akses')->toArray();
        $this->isEdit = true;
        $this->showModal = true;
        // $role = Role::findOrFail($id);
    
        // $this->roleId = $role->id_role;
        // $this->name = $role->name;
        // $this->isEdit = true;
        // $this->showModal = true;
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

    public function updatedRanah($value)
    {
        if ($value === 'Mobile') {
            $this->selectedPermissions = []; // clear checkbox
        }
    }

    public function resetForms()
    {
        $this->name = '';
        $this->ranah = '';
        $this->selectedPermissions = [];
        $this->showModal = false;
        $this->isEdit = false;
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        $roles = Role::latest()->get();

        // Ambil default permission dari config, lalu bentuk sebagai object manual (karena kita tidak ambil dari DB)
        $this->allPermissions = collect(config('default_permissions'))->map(function ($item, $index) {
            return (object) [
                'id' => $item, // langsung pakai nama sebagai ID
                'akses' => ucfirst(str_replace('_', ' ', $item))
            ];
        });

        return view('livewire.setting.roles', compact('roles'));
        // $roles = Role::latest()->get();
        // $this->allPermissions = Permission::all();
        // return view('livewire.setting.roles', compact('roles'));
        // $roles = Role::latest()->get();
        // return view('livewire.setting.roles', compact('roles'));
    }
}