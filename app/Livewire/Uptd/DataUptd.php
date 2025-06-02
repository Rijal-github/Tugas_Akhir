<?php

namespace App\Livewire\Uptd;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\Uptd;
use App\Models\Supir;

class DataUptd extends Component
{

    public $id_kendaraan, $id_supir, $no_polisi, $jenis_kendaraan, $kapasitas_angkutan, $wilayah, $keterangan;
    public $isEdit = false, $showModal = false, $confirmingDelete = false, $deleteId;

    public $jenis_tps;
    public $tahun;
    public $jumlah;


    public function openCreateForm()
    {
        $this->resetForm();
        $this->isEdit = false;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate([
            'nama_uptd' => 'required|string',
            'tahun' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'lokasi_unit.*.nama_lokasi' => 'required|string',
            'lokasi_unit.*.unit' => 'required|string',
            'lokasi_unit.*.latitude' => 'required|numeric',
            'lokasi_unit.*.longitude' => 'required|numeric',
        ]);

        $tps = Uptd::create([
            'nama_uptd' => $this->nama_uptd,

        ]);

            foreach ($this->lokasi_unit as $lok) {
                Supir::create([
                    'tps_id' => $tps->id,
                    'nama_lokasi' => $lok['nama_lokasi'],
                    'unit' => $lok['unit'],
                    'latitude' => $lok['latitude'],
                    'longitude' => $lok['longitude'],
                ]);
            }

        session()->flash('success', 'Data TPS berhasil disimpan.');
        $this->reset(['jenis_tps', 'tahun', 'jumlah', 'nama_lokasi']);

        $this->showModal = false;
    }


    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->jenis_tps = null;
        $this->tahun = null;
        $this->jumlah = null;
      
    }
    
    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.uptd.data-uptd');
    }
}
