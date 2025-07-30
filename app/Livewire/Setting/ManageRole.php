<?php

namespace App\Livewire\Setting;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use App\Models\Role;
use App\Models\Uptd;
use App\Models\UserUptd;
use Illuminate\Support\Facades\Hash;

class ManageRole extends Component
{
    use WithFileUploads;

    public $users;
    public $roles;
    public $uptdList = [];

    public $showModal = false;
    public $confirmDelete = false;
    public $successMessage = '';
    public $showSuccess = false;
    public $isEditMode = false;
    public $confirmDeleteId = null;

    public $userId;
    public $avatar;
    public $email;
    public $username;
    public $no_hp;
    public $name;
    public $alamat_user;
    public $password;
    public $role;
    public $id_uptd;
    public $uptdEnabled = false;

    protected function rules()
    {
        $rules = [
            'role' => 'required|exists:roles,id',
            'email' => 'required|email',
            'name' => 'required',
            'username' => 'required|string|alpha_dash|unique:users,username,' . $this->userId,
            'alamat_user' => 'required',
        ];

        if ($this->isEditMode && in_array($this->role, [2, 6])) {
            $rules['id_uptd'] = 'required|exists:uptd,id_uptd';
        }

        if (!$this->isEditMode || $this->password) {
            $rules['password'] = 'nullable|min:8';
        }

        return $rules;
    }

    public function mount()
    {
        $this->users = User::all();
        $this->roles = Role::all();
    }

    public function openCreateModal()
    {
        $this->resetForm();
        $this->isEditMode = false;
        $this->showModal = true;
    }

    public function openEditModal($id)
    {
        // $user = User::findOrFail($id);
        $user = User::with('uptds')->findOrFail($id);

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
        $this->setUptdState($this->role);

        $this->showModal = true;
    }

    public function updatedRole($value)
    {
        $this->setUptdState($value);
    }

    private function setUptdState($roleId)
    {
        if (in_array($roleId, [2, 6])) {
            $this->uptdEnabled = true;
            $this->uptdList = Uptd::all();
        } else {
            $this->uptdEnabled = false;
            $this->id_uptd = null;
            $this->uptdList = [];
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode) {
            $user = User::findOrFail($this->userId);
            $user->update([
                'id_role' => $this->role,
                'email' => $this->email,
                'username' => $this->username,
                'no_hp' => $this->no_hp,
                'name' => $this->name,
                'alamat_user' => $this->alamat_user,
                'password' => $this->password ? Hash::make($this->password) : $user->password,
            ]);

            if ($this->uptdEnabled && $this->id_uptd) {
                UserUptd::updateOrCreate(
                    ['user_id' => $user->id],
                    ['id_uptd' => $this->id_uptd]
                );
            } else {
                UserUptd::where('user_id', $user->id)->delete();
            }
        } else {
            $user = User::create([
                'id_role' => $this->role,
                'email' => $this->email,
                'username' => $this->username,
                'no_hp' => $this->no_hp,
                'name' => $this->name,
                'alamat_user' => $this->alamat_user,
                'password' => Hash::make($this->password),
            ]);

            if (in_array((int) $this->role, [2, 6])) {
                $defaultUptd = Uptd::first();
                if ($defaultUptd) {
                    UserUptd::create([
                        'user_id' => $user->id,
                        'id_uptd' => $defaultUptd->id_uptd,
                    ]);
                }
            }
        }

        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();
        }

        $message = $this->isEditMode ? 'Data berhasil diperbarui.' : 'Data berhasil disimpan.';
        $this->showSuccessMessages($message);
        $this->closeModal();
        $this->mount();
    }

    // public function save()
    // {
    //     $this->validate();

    //     if ($this->isEditMode) {
    //         $user = User::findOrFail($this->userId);
    //         $user->update([
    //             'id_role' => $this->role,
    //             'email' => $this->email,
    //             'username' => $this->username,
    //             'no_hp' => $this->no_hp,
    //             'name' => $this->name,
    //             'alamat_user' => $this->alamat_user,
    //             'password' => $this->password ? Hash::make($this->password) : $user->password,
    //         ]);
    //     } else {
    //         $user = User::create([
    //             'id_role' => $this->role,
    //             'email' => $this->email,
    //             'username' => $this->username,
    //             'no_hp' => $this->no_hp,
    //             'name' => $this->name,
    //             'alamat_user' => $this->alamat_user,
    //             'password' => Hash::make($this->password),
    //         ]);

    //         if ($this->uptdEnabled) {
    //             UserUptd::create([
    //                 'user_id' => $user->id,
    //                 'id_uptd' => $this->id_uptd,
    //             ]);
    //         }else {
    //                 UserUptd::where('user_id', $user->id)->delete();
    //         }
    //     }
            // if ($this->uptdEnabled && $this->id_uptd) {
            //         UserUptd::updateOrCreate(
            //             ['user_id' => $user->id],
            //             ['id_uptd' => $this->id_uptd]
            //         );
            //     } else {
            //         UserUptd::where('user_id', $user->id)->delete();
            //     }
            // }
                // if (in_array((int) $this->role, [2, 6])) {
                //     $defaultUptd = Uptd::first();
                //     if ($defaultUptd) {
                //         UserUptd::create([
                //             'user_id' => $user->id,
                //             'id_uptd' => $defaultUptd->id_uptd,
                //         ]);
                //     }
                // }


    //     if ($this->avatar) {
    //         $avatarPath = $this->avatar->store('avatars', 'public');
    //         $user->avatar = $avatarPath;
    //         $user->save();
    //     }

    //     $message = $this->isEditMode ? 'Data berhasil diperbarui.' : 'Data berhasil disimpan.';
    //     $this->showSuccessMessages($message);
    //     $this->closeModal();
    //     $this->mount();
    //     $this->role = null;
    //     $this->setUptdState($this->role);
    // }

    public function confirmDeleted($id)
    {
        $this->confirmDelete = true;
        $this->confirmDeleteId = $id;
    }

    public function deleted()
    {
        if ($this->confirmDeleteId) {
            User::find($this->confirmDeleteId)?->delete();
            $this->confirmDelete = false;
            $this->confirmDeleteId = null;
            $this->showSuccessMessages('Data berhasil dihapus.');
        }
    }

    public function cancelDelete()
    {
        $this->closeModal();
    }


    public function closeModal()
    {
        $this->showModal = false;
        $this->confirmDelete = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'userId', 'avatar', 'role', 'email', 'username', 'no_hp', 'name',
            'alamat_user', 'id_uptd', 'password', 'uptdEnabled', 'uptdList'
        ]);
    }

    public function showSuccessMessages(string $message): void
    {
        $this->showSuccess = true;
        $this->successMessage = $message;
    }

    #[\Livewire\Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.setting.manage-role');
    }
}