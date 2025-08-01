<?php

namespace App\Livewire\Tps;

use Livewire\Component;
use Livewire\Attributes;
use Illuminate\Support\Facades\Auth;
use App\Models\Tps;
use App\Models\Uptd;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class DataTps extends Component
{
    use WithFileUploads, WithPagination;

    public $id;
    public $id_uptd;
    public $uptds = [];
    public $showForm = false;
    public $showDetailPopup = false;
    public $showConfirmDelete = false;
    public $showNotification = false;

    public $notificationMessage = '';
    public $formTitle = 'Tambah Data TPS';

    public $selectedTps;
    public $deleteId;

    public $nama, $tahun, $jenis_tps, $lokasi, $latitude, $longitude, $keterangan, $foto_tps;
    public $old_foto;

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
        // $this->tpsList = Tps::orderBy('tahun', 'desc')->get();
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
        'id' => $tps->id,
        'id_uptd' => $tps->id_uptd,
        'nama' => $tps->nama,
        'tahun' => $tps->tahun,
        'jenis_tps' => $tps->jenis_tps,
        'lokasi' => $tps->lokasi,
        'latitude' => $tps->latitude,
        'longitude' => $tps->longitude,
        'keterangan' => $tps->keterangan,
        'old_foto' => $tps->foto_tps,
    ]);
    $this->selectedTps = $tps;
    $this->formTitle = 'Update Data TPS';
    $this->showForm = true;
}

    public function save()
{
    $this->validate([
        'id_uptd' => 'required|exists:uptd,id_uptd',
        'nama' => 'required|string|max:255',
        'tahun' => 'required|integer',
        'jenis_tps' => 'required|string|max:255',
        'lokasi' => 'required|string|max:255',
        'latitude' => 'required|numeric',
        'longitude' => 'required|numeric',
        'keterangan' => 'required|string|max:500',
        'foto_tps' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
    ]);

    $fotoPath = null;
    if ($this->foto_tps) {
        $fotoPath = $this->foto_tps->store('tps_images', 'public');
    }

    $tps = Tps::findOrFail($this->id);
    $tps->id_uptd = $this->id_uptd;
    $tps->nama = $this->nama;
    $tps->tahun = $this->tahun;
    $tps->jenis_tps = $this->jenis_tps;
    $tps->lokasi = $this->lokasi;
    $tps->latitude = $this->latitude;
    $tps->longitude = $this->longitude;
    $tps->keterangan = $this->keterangan;

    if ($fotoPath) {
        $tps->foto_tps = $fotoPath;
    }

    $tps->save();

    $message = 'Data TPS berhasil diperbaharui.';

    // if ($this->id) {
    //     $tps = Tps::findOrFail($this->id);
    //     $tps->id_uptd = $this->id_uptd;
    //     $tps->nama = $this->nama;
    //     $tps->tahun = $this->tahun;
    //     $tps->jenis_tps = $this->jenis_tps;
    //     $tps->lokasi = $this->lokasi;
    //     $tps->latitude = $this->latitude;
    //     $tps->longitude = $this->longitude;
    //     $tps->keterangan = $this->keterangan;

    //     if ($fotoPath) {
    //         $tps->foto_tps = $fotoPath;
    //     }

    //     $tps->save();

    //     $message = 'Data TPS berhasil diperbaharui.';
    // } else {
    //     Tps::create([
    //         'id_uptd' => $this->id_uptd,
    //         'nama' => $this->nama,
    //         'tahun' => $this->tahun,
    //         'jenis_tps' => $this->jenis_tps,
    //         'lokasi' => $this->lokasi,
    //         'latitude' => $this->latitude,
    //         'longitude' => $this->longitude,
    //         'keterangan' => $this->keterangan,
    //         'foto_tps' => $fotoPath,
    //         'created_by' => Auth::id(),
    //     ]);

    //     $message = 'Data TPS berhasil ditambahkan.';
    // }

    $this->showSuccessMessage($message); 

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
        $this->id = null;
        $this->nama = '';
        $this->tahun = '';
        $this->jenis_tps = '';
        $this->lokasi = '';
        $this->latitude = '';
        $this->longitude = '';
        $this->keterangan = '';
        $this->foto_tps = null;
        $this->id_uptd = '';
        $this->selectedTps = null;
        $this->old_foto = null;
    }

    public function closeNotification()
    {
        $this->showNotification = false;
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        $tpsList = Tps::latest()->paginate(10);
        return view('livewire.tps.data-tps', compact('tpsList'));
        // return view('livewire.tps.data-tps');

    }
}
