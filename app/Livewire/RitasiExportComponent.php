<?php

namespace App\Livewire;

use App\Exports\RitasiExport;
use App\Models\Ritasi;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RitasiExportComponent implements FromView
{
    protected $data;
    protected $filterType;
    protected $tanggal;
    protected $bulan;
    protected $tahun;
    protected $selectedTPA;

    public function __construct($data, $filterType, $tanggal, $bulan, $tahun, $selectedTPA)
    {
        $this->data = $data;
        $this->filterType = $filterType;
        $this->tanggal = $tanggal;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
        $this->selectedTPA = $selectedTPA;
    }

    public function view(): View
    {
        $viewName = match ($this->filterType) {
            'daily' => 'exports.ritasi.harian',
            'weekly' => 'exports.ritasi.mingguan',
            'monthly' => 'exports.ritasi.bulanan',
            'yearly' => 'exports.ritasi.tahunan',
            default => throw new \Exception('Filter tidak valid'),
        };

        return view($viewName, [
            'data' => $this->data,
            'tanggal' => $this->tanggal,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
            'selectedTPA' => $this->selectedTPA,
        ]);
    }
}

// class RitasiExportComponent extends Component
// {
//     public $filterType = 'daily'; // daily, weekly, monthly, yearly
//     public $tanggal;
//     public $bulan;
//     public $tahun;

//     public function mount()
//     {
//         $this->tanggal = now()->format('Y-m-d');
//         $this->bulan = now()->format('m');
//         $this->tahun = now()->format('Y');
//     }

//     public function render()
//     {
//         return view('livewire.data.tpa');
//     }

//     public function export()
//     {
//         $data = $this->getFilteredData();
//         return Excel::download(new RitasiExport($data), 'laporan_ritasi_' . $this->filterType . '.xlsx');
//     }

//     public function getFilteredData(): Collection
//     {
//         $query = Ritasi::with(['driver', 'vehicle']);

//         switch ($this->filterType) {
//             case 'daily':
//                 $query->whereDate('tanggal_ritasi', $this->tanggal);
//                 break;

//             case 'weekly':
//                 $start = Carbon::parse($this->tanggal)->startOfWeek();
//                 $end = Carbon::parse($this->tanggal)->endOfWeek();
//                 $query->whereBetween('tanggal_ritasi', [$start, $end]);
//                 break;

//             case 'monthly':
//                 $query->whereYear('tanggal_ritasi', $this->tahun)
//                       ->whereMonth('tanggal_ritasi', $this->bulan);
//                 break;

//             case 'yearly':
//                 $query->whereYear('tanggal_ritasi', $this->tahun);
//                 break;
//         }

//         $results = $query->get();

//         return $results->groupBy('id_driver')->map(function ($items) {
//             $driver = $items->first()->driver;
//             $vehicle = $items->first()->vehicle;
//             $totalNetto = $items->sum(function ($item) {
//                 return $item->netto_post - $item->netto_pre;
//             });
//             $totalRitasi = $items->sum('banyak_ritasi');

//             return [
//                 'driver_name' => $driver->name,
//                 'vehicle' => $vehicle->jenis_kendaraan,
//                 'no_polisi' => $vehicle->no_polisi,
//                 'ritasi' => $totalRitasi,
//                 'netto' => $totalNetto,
//                 'avg_per_day' => round($totalNetto / ($items->count() ?: 1), 2),
//                 'lokasi' => $vehicle->lokasi ?? '-',
//                 'keterangan' => $items->first()->keterangan ?? '-',
//             ];
//         })->values();
//     }
// }