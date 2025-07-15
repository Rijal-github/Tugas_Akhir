<?php

namespace App\Livewire\Uptd;

use Livewire\Component;
use Livewire\Attributes;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Uptd;

class DataUptd extends Component
{
    use WithFileUploads, WithPagination;

    public $id_uptd;
    // public $page; // Tambahkan ini!

    // protected $queryString = ['page'];

    public $nama_uptd, $alamat_uptd, $foto_uptd;
    public $showModal = false, $confirmingDelete = false;

    public bool $showSuccess = false;
    public string $successMessage = '';

    public $confirmingDeleteId = null;
    public $isUpdate = false;

    public function showSuccessMessage(string $message): void
    {
        $this->showSuccess = true;
        $this->successMessage = $message;
    }


    public function store()
    {
        $this->validate([
            'nama_uptd' => 'required|string|max:255',
            'alamat_uptd' => 'required|string|max:255',
            'foto_uptd' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
        ]);

        $fotoPath = null;
        if ($this->foto_uptd) {
            $fotoPath = $this->foto_uptd->store('uptd_images', 'public');
        }

        if ($this->id_uptd) {
            $uptd = Uptd::findOrFail($this->id_uptd);
            $uptd->nama_uptd = $this->nama_uptd;
            $uptd->alamat_uptd = $this->alamat_uptd;
            if ($fotoPath) {
                $uptd->foto_uptd = $fotoPath;
            }
            $uptd->save();
    
            $message = 'Data berhasil diperbaharui.';
        } else {
            Uptd::create([
                'nama_uptd' => $this->nama_uptd,
                'alamat_uptd' => $this->alamat_uptd,
                'foto_uptd' => $fotoPath,
            ]);
    
            $message = 'Data berhasil disimpan.';
        }

         // Jika uptd sudah ada dan foto baru di-upload, update foto
        //  if ($this->foto_uptd && $uptd->foto_uptd !== $fotoPath) {
        //     $uptd->update(['foto_uptd' => $fotoPath]);
        // }

        $this->resetFields();
        $this->showModal = false;

        $this->showSuccessMessage($message);
    }

    public function editForm($id_uptd)
    {
        $uptd = Uptd::findOrFail($id_uptd);
        $this->id_uptd = $uptd->id_uptd;
        $this->nama_uptd = $uptd->nama_uptd;
        $this->alamat_uptd = $uptd->alamat_uptd;
        $this->foto_uptd = $uptd->foto_uptd;
        $this->isUpdate = true;
        $this->showModal = true;
    }

    public function confirmDelete($id_uptd)
    {
        $this->confirmingDelete = true;
        $this->confirmingDeleteId = $id_uptd;
    }

    public function destroy()
    {
        if ($this->confirmingDeleteId) {
            Uptd::find($this->confirmingDeleteId)?->delete();
            $this->confirmingDelete = false;
            $this->confirmingDeleteId = null;
            $this->showSuccessMessage('Data berhasil dihapus.');
        }
    }

    public function resetFields()
    {
        $this->nama_uptd = '';
        $this->alamat_uptd = '';
        $this->foto_uptd = '';
        $this->showModal = false;
        $this->isUpdate = false;
    }


    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.uptd.data-uptd',[
            'uptds' => Uptd::orderBy('id_uptd', 'asc')->paginate(5)
            // ->withQueryString()
        ]);
    }
}