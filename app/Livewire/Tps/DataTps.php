<?php

namespace App\Livewire\Tps;

use Livewire\Component;
use Livewire\Attributes;
use Illuminate\Support\Facades\Auth;
use App\Models\Tps;
use App\Models\Uptd;
use Livewire\WithFileUploads;

class DataTps extends Component
{
    use WithFileUploads;

    public $id;
    public $id_uptd;
    public $uptds = [];
    public $tpsList;
    public $showForm = false;
    public $showDetailPopup = false;
    public $showConfirmDelete = false;
    public $showNotification = false;

    public $notificationMessage = '';
    public $formTitle = 'Tambah Data TPS';

    public $selectedTps;
    public $deleteId;

    public $nama, $tahun, $jenis_tps, $lokasi, $latitude, $longitude, $keterangan, $fotoTPS;
    public $old_foto; // for update

    public function showSuccessMessage($message)
    {
        session()->flash('success', $message);
    }
    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->tpsList = Tps::orderBy('tahun', 'desc')->get();
        $this->uptds = Uptd::all(); 
    }

    public function openCreateForm()
    {
        $this->resetForm();
        $this->formTitle = 'Tambah Data TPS';
        $this->showForm = true;
    }

    public function showDetail($id)
    {
        $this->selectedTps = Tps::find($id);
        $this->showDetailPopup = true;
    }

    public function edit($id)
{
    $tps = Tps::find($id);
    $this->fill([
        $this->nama = $tps->nama,
        $this->tahun = $tps->tahun,
        $this ->jenis_tps = $tps->jenis_tps,
        $this ->lokasi = $tps->lokasi,
        $this ->latitude = $tps->latitude,
        $this ->longitude = $tps->longitude,
        $this ->keterangan = $tps->keterangan,
        $this ->old_foto = $tps->old_foto,
    ]);
    $this->selectedTps = $tps;
    $this->formTitle = 'Update Data TPS';
    $this->showForm = true;
}

    public function save()
{
    $this->validate([
        'id_uptd' => 'required|exists:uptds,id',
        'nama' => 'required|string|max:255',
        'tahun' => 'required|integer',
        'jenis_tps' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'keterangan' => 'required|string|max:500',
        'fotoTPS' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
    ]);

    $fotoPath = null;
    if ($this->fotoTPS) {
        $fotoPath = $this->fotoTPS->store('tps_images', 'public');
    }

    if ($this->id) {
        $tps = Tps::findOrFail($this->id);
        $tps->nama = $this->nama;
        $tps->tahun = $this->tahun;
        $tps->jenis_tps = $this->jenis_tps;
        $tps->lokasi = $this->lokasi;
        $tps->latitude = $this->latitude;
        $tps->longitude = $this->longitude;
        $tps->keterangan = $this->keterangan;

        if ($fotoPath) {
            $tps->fotoTPS = $fotoPath;
        }

        $tps->save();

        $message = 'Data TPS berhasil diperbaharui.';
    } else {
        Tps::create([
            'nama' => $this->nama,
            'tahun' => $this->tahun,
            'jenis_tps' => $this->jenis_tps,
            'lokasi' => $this->lokasi,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'keterangan' => $this->keterangan,
            'fotoTPS' => $fotoPath,
            'created_by' => Auth::id(),
            'id_uptd' => $this->id_uptd,
        ]);

        $message = 'Data TPS berhasil ditambahkan.';
    }

    $this->showSuccessMessage($message); // tampilkan notifikasi sukses

    $this->resetForm();
    $this->loadData();
    $this->showForm = false;
    $this->showNotification = true;
}



    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showConfirmDelete = true;
    }

    public function delete()
    {
        Tps::find($this->deleteId)?->delete();
        $this->loadData();
        $this->showConfirmDelete = false;
        $this->notificationMessage = 'Data TPS berhasil dihapus.';
        $this->showNotification = true;
    }

    public function resetForm()
    {
        // $this->reset([
        //     'nama', 'tahun', 'jenis_tps', 'lokasi', 'latitude', 'longitude', 'keterangan', 'fotoTps',
        //     'selectedTps',
        // ]);

        // $this->id_tps = null;
        $this->nama = '';
        $this->tahun = '';
        $this->jenis_tps = '';
        $this->lokasi = '';
        $this->latitude = '';
        $this->longitude = '';
        $this->keterangan = '';
        $this->selectedTps = null;
    }

    public function closeNotification()
    {
        $this->showNotification = false;
    }


    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.tps.data-tps');

    }
}
