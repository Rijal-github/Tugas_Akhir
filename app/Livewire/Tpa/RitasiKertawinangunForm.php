<?php

namespace App\Livewire\Tpa;

use Livewire\Component;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\RitasiKertawinangun;

class RitasiKertawinangunForm extends Component
{
    public $vehicle;
    public $id_driver = '';
    public $bruto, $netto, $banyak_ritasi;
    
    public $selectedVehicleNoPolisi = null;
    public $selectedVehicleJenis = null;
    public $id_vehicle = null;
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
            'bruto' => 'required|numeric',
            'netto' => 'required|numeric',
            'banyak_ritasi' => 'required|integer|min:1',
            'keterangan' => 'required|string',
        ]);

        RitasiKertawinangun::create([
            'id_driver' => $this->id_driver,
            'id_vehicle' => $this->id_vehicle,
            'bruto' => $this->bruto,
            'netto' => $this->netto,
            'banyak_ritasi' => $this->banyak_ritasi,
            'keterangan' => $this->keterangan,
            'ritasi' => 1,
        ]);

        session()->flash('message', 'Data berhasil disimpan.');
        $this->reset();
    }

   public function updatedKeteranganSelect($value)
    {
        if ($value !== 'Lainnya') {
            $this->keterangan = $value;
        } else {
            $this->keterangan = '';
        }
    }

    public function render()
    {
       $drivers = User::whereHas('vehicles')
        ->where('id_role', 5)
        ->get();

        return view('livewire.tpa.ritasi-kertawinangun-form', [
            'drivers' => $drivers,
        ]);
    }
}
