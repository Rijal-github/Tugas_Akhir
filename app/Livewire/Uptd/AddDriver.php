<?php

namespace App\Livewire\Uptd;

use Livewire\Component;
use Livewire\Attributes;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Uptd;
use App\Models\Vehicle;
use App\Models\User;

class AddDriver extends Component
{
    use WithFileUploads, WithPagination;

    public $uptd_id;
    public $id_driver;
    public $selected_user_id;
    public $vehicle_id = null;
    public $no_polisi;
    public $jenis_kendaraan;
    public $kapasitas_angkutan;
    public $showDriverModal = false;
    public $confirmingDeleteDriverId = null;


    public function mount($driver)
    {
        $this->uptd_id = $driver;
    }

    public function storeDriver()
    {
        $this->validate([
            'selected_user_id' => 'required|exists:users,id',
            'no_polisi' => 'required|string|max:50',
            'jenis_kendaraan' => 'required|string|max:100',
            'kapasitas_angkutan' => 'required|numeric',
        ]);

        Vehicle::updateOrCreate(
            [
                'id' => $this->vehicle_id,
            ],
            [
                'id_driver' => $this->selected_user_id,
                'id_uptd' => $this->uptd_id,
                'no_polisi' => $this->no_polisi,
                'jenis_kendaraan' => $this->jenis_kendaraan,
                'kapasitas_angkutan' => $this->kapasitas_angkutan,
            ]
        );

        $this->resetDriverForm();
        $this->showDriverModal = false;
    }

    public function editDriver($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $this->vehicle_id = $vehicle->id;
        $this->selected_user_id = $vehicle->id_driver;
        $this->no_polisi = $vehicle->no_polisi;
        $this->jenis_kendaraan = $vehicle->jenis_kendaraan;
        $this->kapasitas_angkutan = $vehicle->kapasitas_angkutan;
        $this->showDriverModal = true;
    }

    public function confirmDeleteDriver($id)
    {
        $this->confirmingDeleteDriverId = $id;
    }

    public function deleteDriver()
    {
        if ($this->confirmingDeleteDriverId) {
            Vehicle::findOrFail($this->confirmingDeleteDriverId)->delete();
            $this->confirmingDeleteDriverId = null;
        }
    }

    public function resetDriverForm()
    {
        $this->vehicle_id = null;
        $this->selected_user_id = '';
        $this->no_polisi = '';
        $this->jenis_kendaraan = '';
        $this->kapasitas_angkutan = '';
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        $uptd = Uptd::findOrFail($this->uptd_id);
        $users = User::where('id_role', 5)->get();

        return view('livewire.uptd.add-driver', [
            'uptd' => $uptd,
            'drivers' => Vehicle::with('driver')->where('id_uptd', $this->uptd_id)->paginate(5),
            'users' => $users,
        ]);
    }
}
