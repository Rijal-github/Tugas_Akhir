<?php

namespace App\Livewire\Tpa;

use Livewire\Component;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\RitasiKertawinangun;

class RitasiKertawinangunForm extends Component
{
    public $id_driver, $vehicle_id;
    public $netto_pre, $netto_post, $banyak_ritasi, $keterangan;

    public $vehicles;

    public function updatedDriverId($value)
    {
        $this->vehicles = Vehicle::where('id_driver', $value)->get();
        $this->vehicle_id = $this->vehicles->first()->id ?? null;
    }

    public function save()
    {
        $this->validate([
            'id_driver' => 'required',
            'vehicle_id' => 'required',
            'netto_pre' => 'required|numeric',
            'netto_post' => 'required|numeric',
            'banyak_ritasi' => 'required|integer|min:1',
        ]);

        RitasiKertawinangun::create([
            'id_driver' => $this->id_driver,
            'netto_pre' => $this->netto_pre,
            'netto_post' => $this->netto_post,
            'banyak_ritasi' => $this->banyak_ritasi,
            'keterangan' => $this->keterangan,
        ]);

        session()->flash('message', 'Data berhasil disimpan.');
        $this->reset(); // reset form
    }

    public function batal()
    {
        $this->dispatch('batalInputRitasi'); // kirim ke komponen induk
    }

    public function render()
    {
        $drivers = User::whereHas('vehicles')
            ->where('id_role', 5) // asumsi 2 = driver
            ->get();

        return view('livewire.tpa.ritasi-kertawinangun-form', [
            'drivers' => $drivers,
            'vehicles' => $this->vehicles,
        ]);
    }

    // public function render()
    // {
    //     return view('livewire.tpa.ritasi-kertawinangun-form');
    // }
}
