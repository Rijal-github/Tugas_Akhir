<?php

namespace App\Livewire\Tpa;

use Livewire\Component;
use Livewire\Attributes;
use App\Exports\RitasiExport;
use App\Models\Ritasi;
use App\Models\RitasiKertawinangun;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class DataTpa extends Component
{
    public string $selectedTPA = 'pecuk';
    public $ritasiPecuk;
    public $ritasiKertawinangun;

    public $ritasiList = [];

    public $filterType = 'daily';
    public $tanggal;
    public $bulan;
    public $tahun;

    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d');
        $this->bulan = now()->format('m');
        $this->tahun = now()->format('Y');

        // $this->ritasiList = Ritasi::with(['vehicle.uptd', 'driver'])
        // ->orderBy('created_at', 'desc')
        // ->get();

        // $this->ritasiKertawinangun = RitasiKertawinangun::with(['vehicle.uptd', 'driver'])
        // ->orderBy('created_at', 'desc')
        // ->get();
    }

    public function export()
    {
        $data = $this->getFilteredData();
        return Excel::download(new RitasiExport($data), 'laporan_ritasi_' . $this->filterType . '.xlsx');
    }

    public function getFilteredData(): Collection
    {
        $query = Ritasi::with(['driver', 'vehicle.uptd']);

        switch ($this->filterType) {
            case 'daily':
                $query->whereDate('created_at',  $this->tanggal);
                break;

            case 'weekly':
                $start = Carbon::parse($this->tanggal)->startOfWeek();
                $end = Carbon::parse($this->tanggal)->endOfWeek();
                $query->whereBetween('created_at', [$start, $end]);
                break;

            case 'monthly':
                $query->whereYear('tanggal_ritasi', $this->tahun)
                      ->whereMonth('tanggal_ritasi', $this->bulan);
                // $month = \Carbon\Carbon::parse($this->selectedDate)->month;
                // $year = \Carbon\Carbon::parse($this->selectedDate)->year;
                // $query->whereMonth('created_at', $month)->whereYear('created_at', $year);
                break;

            case 'yearly':
                $query->whereYear('created_at', $this->tahun);
                break;
        }

        $results = $query->get();

        return $results->groupBy('id_driver')->map(function ($items) {
            $driver = $items->first()->driver;
            $vehicle = $items->first()->vehicle;
            $totalNetto = $items->sum(function ($item) {
                return $item->bruto - $item->netto;
            });
            $totalRitasi = $items->sum('banyak_ritasi');

            return [
                'driver_name' => $driver->name,
                'vehicle' => $vehicle->jenis_kendaraan,
                'no_polisi' => $vehicle->no_polisi,
                'ritasi' => $totalRitasi,
                'netto' => $totalNetto,
                'avg_per_day' => round($totalNetto / ($items->count() ?: 1), 2),
                'lokasi' => $vehicle->uptd->nama_uptd ?? '-',
                'keterangan' => $items->first()->keterangan ?? '-',
            ];
        })->values();
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        Log::info('Selected TPA: ' . $this->selectedTPA);

        // Ambil data sesuai TPA yang dipilih
    if ($this->selectedTPA === 'pecuk') {
        $this->ritasiList = Ritasi::with(['driver', 'vehicle.uptd'])
            ->orderBy('created_at', 'desc')
            ->get();
    } elseif ($this->selectedTPA === 'kertawinangun') {
        $this->ritasiList = RitasiKertawinangun::with(['driver', 'vehicle.uptd'])
            ->orderBy('created_at', 'desc')
            ->get();
    } else {
        $this->ritasiList = collect();
    }

      return view('livewire.tpa.data-tpa');
    }
}
