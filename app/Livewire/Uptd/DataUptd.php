<?php

namespace App\Livewire\Uptd;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\Uptd;
use App\Models\Vehicle;
use App\Models\User;

class DataUptd extends Component
{

    public $vehicles, $jenis_kendaraan, $no_polisi, $kapasitas_angkutan, $nama_uptd, $vehicle_id;
    public $showModal = false, $confirmingDelete = false;

    public $driver_id;
    public $drivers = [];

    public bool $showSuccess = false;
    public string $successMessage = '';

    public $confirmingDeleteId = null;
    public $isUpdate = false;

    public function showSuccessMessage(string $message): void
    {
        $this->showSuccess = true;
        $this->successMessage = $message;
        // Tambahkan logika untuk menyembunyikan popup setelah beberapa detik, jika diperlukan.
        // Misalnya, menggunakan JavaScript atau metode Livewire.
    }


    public function store()
    {
        $this->validate([
            'jenis_kendaraan' => 'required|string|max:255',
            'no_polisi' => 'required|string|max:255',
            'kapasitas_angkutan' => 'required|numeric',
            'nama_uptd' => 'required',
            'driver_id' => 'required|exists:users,id',
        ]);

        $uptd = Uptd::firstOrCreate(['nama_uptd' => $this->nama_uptd]);
        $driver = User::where('id_role', 'driver')->first();

        Vehicle::updateOrCreate(
            ['id' => $this->vehicle_id],
            [
                'jenis_kendaraan' => $this->jenis_kendaraan,
                'no_polisi' => $this->no_polisi,
                'kapasitas_angkutan' => $this->kapasitas_angkutan,
                'id_uptd' => $uptd->id_uptd,
                'id_driver' => $this->driver_id
            ]
        );

        $message = $this->vehicle_id ? 'Data berhasil diperbaharui.' : 'Data berhasil disimpan.';

        $this->resetFields();
        $this->showModal = false;

        $this->showSuccessMessage($message);
    }

    public function editForm($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $this->vehicle_id = $id;
        $this->driver_id = $vehicle->id_driver;
        $this->jenis_kendaraan = $vehicle->jenis_kendaraan;
        $this->no_polisi = $vehicle->no_polisi;
        $this->kapasitas_angkutan = $vehicle->kapasitas_angkutan;
        $this->nama_uptd = $vehicle->uptd->nama_uptd ?? '';
        $this->isUpdate = true;
        $this->showModal = true;
    }

    public function confirmDelete($id)
    {
        $this->confirmingDelete = true;
        $this->confirmingDeleteId = $id;
    }

    public function destroy()
    {
        // Vehicle::find($id)->delete();
        if ($this->confirmingDeleteId) {
            Vehicle::find($this->confirmingDeleteId)?->delete();
            $this->confirmingDelete = false;
            $this->confirmingDeleteId = null;
            $this->showSuccessMessage('Data berhasil dihapus.');
        }
    }

    public function resetFields()
    {
        $this->jenis_kendaraan = '';
        $this->no_polisi = '';
        $this->kapasitas_angkutan = '';
        $this->nama_uptd = '';
        $this->driver_id = '';
        $this->showModal = false;
        $this->isUpdate = false;
    }


    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        // $this->vehicles = Vehicle::with(['uptd', 'driver'])->latest()->get();
        $this->vehicles = Vehicle::with(['uptd', 'driver'])->latest()->get();
        $this->drivers = User::whereHas('role', function($query) {
            $query->where('name', 'driver');
        })->get();

        return view('livewire.uptd.data-uptd');
    }
}






    // public function save()
    // {
    //     $this->validate([
    //         'nama_uptd' => 'required|string',
    //         'kendaraan_unit.*.id_driver' => 'required|integer|exists:users,id', // jika ada tabel driver
    //         'kendaraan_unit.*.no_polisi' => 'required|string|max:255',
    //         'kendaraan_unit.*.jenis_kendaraan' => 'required|string|max:255',
    //         'kendaraan_unit.*.kapasitas_angkutan' => 'required|numeric|min:0',
    //     ]);

    //     $uptd = Uptd::create([
    //         'nama_uptd' => $this->nama_uptd,

    //     ]);

    //         foreach ($this->vehicles as $vehicle) {
    //             Vehicle::create([
    //                 'id_driver' => $vehicle['id_driver'],
    //                 'id_uptd' => $uptd->id, // pastikan pakai primary key yang benar
    //                 'no_polisi' => $vehicle['no_polisi'],
    //                 'jenis_kendaraan' => $vehicle['jenis_kendaraan'],
    //                 'kapasitas_angkutan' => $vehicle['kapasitas_angkutan'],
    //             ]);
    //         }

    //     session()->flash('success', 'Data UPTD berhasil disimpan.');
    //     $this->reset(['nama_uptd', 'no_polisi', 'kapasitas_angkutan', 'jenis_kendaraan']);

    //     $this->showModal = false;
    // }