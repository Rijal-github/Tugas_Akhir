<?php

namespace App\Livewire\Tpa;

use Livewire\Component;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Ritasi;

class RitasiPecukForm extends Component
{

    // public array $vehicles = [];
    public $vehicle;
    public $id_driver = '';
    public $bruto, $netto, $banyak_ritasi;

    public $selectedVehicleNoPolisi = null;
    public $selectedVehicleJenis = null;
    public $id_vehicle = null;

    // public $keteranganSelect = '';
    public $keterangan = '';


    public function updatedIdDriver($value)
    {
        logger('Supir dipilih: ' . $value);
        if (!$value) {
            $this->selectedVehicleNoPolisi = '';
            $this->selectedVehicleJenis = '';
            $this->id_vehicle = null;
            return;
        }
    
        $vehicle = Vehicle::where('id_driver', $value)->first();
    
        if ($vehicle) {
            $this->selectedVehicleNoPolisi = $vehicle->no_polisi;
            $this->selectedVehicleJenis = $vehicle->jenis_kendaraan;
            $this->id_vehicle = $vehicle->id;
        } else {
            $this->selectedVehicleNoPolisi = '—';
            $this->selectedVehicleJenis = '—';
            $this->id_vehicle = null;
        }
       
    }

    public function save()
    {
        $this->validate([
            'id_driver' => 'required',
            'id_vehicle' => 'required',
            // 'tanggal_ritasi' => 'required|date',
            'bruto' => 'required|numeric',
            'netto' => 'required|numeric',
            'banyak_ritasi' => 'required|integer|min:1',
            'keterangan' => 'required|string',
        ]);

        Ritasi::create([
            'id_driver' => $this->id_driver,
            'id_vehicle' => $this->id_vehicle,
            // 'tanggal_ritasi' => $this->tanggal_ritasi,
            'bruto' => $this->bruto,
            'netto' => $this->netto,
            'banyak_ritasi' => $this->banyak_ritasi,
            'keterangan' => $this->keterangan,
            'ritasi' => 1,
        ]);

        session()->flash('message', 'Data berhasil disimpan.');
        $this->reset(); // reset form
    }

    public function updatedKeteranganSelect($value)
    {
        if ($value !== 'Lainnya') {
            $this->keterangan = $value;
        } else {
            $this->keterangan = '';
        }
    }

    // public function batal()
    // {
    //     $this->dispatch('batalInputRitasi'); // kirim ke komponen induk
    // }

    public function render()
    {
        $drivers = User::whereHas('vehicles')
            ->where('id_role', 5) // asumsi 5 = driver
            ->get();

        // $drivers = User::where('id_role', 5)->get(); // tampilkan semua supir

        return view('livewire.tpa.ritasi-pecuk-form', [
            'drivers' => $drivers,
            // 'vehicles' => $this->vehicles,
        ]);
    }

}
    // public function render()
    // {
    //     return view('livewire.tpa.ritasi-pecuk-form');
    // }
