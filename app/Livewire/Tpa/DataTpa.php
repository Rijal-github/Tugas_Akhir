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
    public $filterType = 'harian';
    public ?string $tanggal = null;
    public ?string $bulan = null;
    public ?string $tahun = null;

    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d');
        $this->bulan = now()->format('m');
        $this->tahun = now()->format('Y');
    }

    public function export()
    {
        Log::info('Filter type selected:', [
        'filterType' => $this->filterType,
        'tanggal' => $this->tanggal,
        'bulan' => $this->bulan,
        'tahun' => $this->tahun,
        'selectedTPA' => $this->selectedTPA,
    ]);
        $model = $this->selectedTPA === 'kertawinangun' 
            ? RitasiKertawinangun::class 
            : Ritasi::class;

            $data = $this->getFilteredData($model);

            return Excel::download(
                new \App\Exports\RitasiExport(
                    $data,
                    $this->filterType,
                    $this->tanggal,
                    $this->bulan,
                    $this->tahun,
                    $this->selectedTPA
                ),
            'laporan_ritasi_' . $this->filterType . '_' . $this->selectedTPA . '.xlsx'
        );
    }
    
    public function getFilteredData($model): Collection
    {
        $query = $model::query();

        if ($this->filterType === 'harian') {
            $query->whereDate('created_at', $this->tanggal);
        }

        if ($this->filterType === 'mingguan') {
            $startOfWeek = Carbon::parse($this->tanggal)->startOfWeek();
            $endOfWeek = Carbon::parse($this->tanggal)->endOfWeek();

            $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }

        if ($this->filterType === 'bulanan') {
            $query->whereMonth('created_at', $this->bulan)
                ->whereYear('created_at', $this->tahun);
        }

        if ($this->filterType === 'tahunan') {
            $query->whereYear('created_at', $this->tahun);
        }

        $results = $query->get();

        return $results->groupBy('id_driver')->map(function ($items) {
            $driver = $items->first()->driver;
            $vehicle = $items->first()->vehicle;
            $totalNetto = $items->sum(function ($item) {
                return $item->bruto - $item->tara;
            });
            $totalRitasi = $items->sum('banyak_ritasi');

            return [
                'driver_name' => $driver->name ?? '-',
                'vehicle' => $vehicle->jenis_kendaraan ?? '-',
                'no_polisi' => $vehicle->no_polisi ?? '-',
                'ritasi' => $totalRitasi,
                'netto' => $totalNetto,
                'avg_per_day' => round($totalNetto / max($items->count(), 1), 2),
                'lokasi' => $vehicle->uptd->nama_uptd ?? '-',
                'keterangan' => $items->first()->keterangan ?? '-',
            ];
        })->values(); 
    }


    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        Log::info('Selected TPA: ' . $this->selectedTPA);

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
