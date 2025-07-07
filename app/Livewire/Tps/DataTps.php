<?php

namespace App\Livewire\Tps;

use Livewire\Component;
use Livewire\Attributes;
use App\Models\Tps;
use App\Models\Lokasi;

class DataTps extends Component
{
    public $showEdit= false;
    public $showForm= false;

    public $dataTps;
    public $nama_lokasi = '';
    public $editTpsId;
    public $jenis_tps;
    public $tahun;
    public $jumlah;
    public $lokasi_unit = [
        ['nama_lokasi' => '', 'unit' => '', 'latitude' => '', 'longitude' => '']
    ];

    public function addLocation()
    {
        $this->lokasi_unit[] = ['nama_lokasi' => '', 'unit' => '', 'latitude' => '', 'longitude' => ''];
    }

    public function removeLocation($index)
    {
        unset($this->lokasi_unit[$index]);
        $this->lokasi_unit = array_values($this->lokasi_unit); // reset index
    }

    public function openCreateForm()
    {
        $this->resetForm();
        $this->showEdit = false;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate([
            'jenis_tps' => 'required|string',
            'tahun' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'lokasi_unit.*.nama_lokasi' => 'required|string',
            'lokasi_unit.*.unit' => 'required|string',
            'lokasi_unit.*.latitude' => 'required|numeric',
            'lokasi_unit.*.longitude' => 'required|numeric',
        ]);

        $tps = Tps::create([
            'jenis_tps' => $this->jenis_tps,
            'tahun' => $this->tahun,
            'jumlah' => $this->jumlah,
        ]);

            // foreach ($this->lokasi_unit as $lok) {
            //     Lokasi::create([
            //         'tps_id' => $tps->id,
            //         'nama_lokasi' => $lok['nama_lokasi'],
            //         'unit' => $lok['unit'],
            //         'latitude' => $lok['latitude'],
            //         'longitude' => $lok['longitude'],
            //     ]);
            // }

        session()->flash('success', 'Data TPS berhasil disimpan.');
        $this->reset(['jenis_tps', 'tahun', 'jumlah', 'nama_lokasi']);
        $this->lokasi_unit = [['nama_lokasi' => '', 'unit' => '', 'latitude' => '', 'longitude' => '']];

        $this->showForm = false;
    }

    public function edit($id)
    {
        $this->resetForm();
        $this->showEdit = true;
        $this->showForm = true;

        $tps = Tps::with('lokasi')->findOrFail($id);
        $this->editTpsId = $tps->id;
        $this->jenis_tps = $tps->jenis_tps;
        $this->tahun = $tps->tahun;
        $this->jumlah = $tps->jumlah;

        $this->lokasi_unit = $tps->lokasi->map(function ($lok) {
            return [
                'nama_lokasi' => $lok->nama_lokasi,
                'unit' => $lok->unit,
                'latitude' => $lok->latitude,
                'longitude' => $lok->longitude,
            ];
        })->toArray();
    }

    public function update()
    {
        $this->validate([
            'jenis_tps' => 'required|string',
            'tahun' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'lokasi_unit.*.nama_lokasi' => 'required|string',
            'lokasi_unit.*.unit' => 'required|string',
            'lokasi_unit.*.latitude' => 'required|numeric',
            'lokasi_unit.*.longitude' => 'required|numeric',
        ]);

        $tps = Tps::findOrFail($this->editTpsId);
        $tps->update([
            'jenis_tps' => $this->jenis_tps,
            'tahun' => $this->tahun,
            'jumlah' => $this->jumlah,
        ]);

        // Hapus lokasi lama
        // $tps->lokasi()->delete();

        // // Tambah lokasi baru
        // foreach ($this->lokasi_unit as $lok) {
        //     Lokasi::create([
        //         'tps_id' => $tps->id,
        //         'nama_lokasi' => $lok['nama_lokasi'],
        //         'unit' => $lok['unit'],
        //         'latitude' => $lok['latitude'],
        //         'longitude' => $lok['longitude'],
        //     ]);
        // }

        session()->flash('success', 'Data TPS berhasil diperbarui.');
        $this->closeModal();
    }

    public function delete($id)
    {
        $tps = Tps::findOrFail($id);
        $tps->lokasi()->delete(); // Hapus lokasi terlebih dahulu
        $tps->delete();

        session()->flash('success', 'Data TPS berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->showForm = false;
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
        $this->dataTps = Tps::with('lokasi')->latest()->get();
        return view('livewire.tps.data-tps');

    }
}
