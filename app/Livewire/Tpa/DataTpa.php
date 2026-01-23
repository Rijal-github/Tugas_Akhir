<?php

namespace App\Livewire\Tpa;

use Livewire\Component;
use Livewire\Attributes;
// use App\Exports\RitasiExport;
use App\Models\Ritasi;
use App\Models\RitasiKertawinangun;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Builder;

class DataTpa extends Component
{
    public string $selectedTPA = 'pecuk';
    public $ritasiPecuk;
    public $ritasiKertawinangun;

    // public Collection $ritasiList = [];
    public Collection $ritasiList;
    public string $filterType = 'harian';
    public ?string $tanggal = null;
    public ?string $minggu = null;
    public ?string $bulan = null;
    public ?string $tahun = null;

    protected string $dateColumn = 'created_at';

    public function mount()
    {
        $this->filterType = 'harian';
        $this->tanggal = now()->toDateString(); // 'Y-m-d'
        $this->minggu = now()->format('o-\WW');
        $this->bulan   = now()->format('m');
        $this->tahun   = now()->format('Y');
        $this->ritasiList = collect();
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

            // $model = $this->getFilteredData($model);

            $rows = $this->getExportData($model);

            return Excel::download(
                new \App\Exports\RitasiExport(
                    $rows,
                    $this->filterType,
                    $this->tanggal,
                    $this->bulan,
                    $this->tahun,
                    $this->selectedTPA
                ),
            'laporan_ritasi_' . $this->filterType . '_' . $this->selectedTPA . '.xlsx'
        );
    }
    
     protected function baseQuery(string $model): Builder
    {
        $dateCol = $this->dateColumn; // ganti ke kolom yang benar

        $q = $model::with(['driver', 'vehicle.uptd']);

        switch ($this->filterType) {
            case 'harian':
                $q->whereDate($dateCol, Carbon::parse($this->tanggal)->toDateString());
                break;

            // case 'mingguan':
            //     $anchor     = Carbon::parse($this->tanggal);
            //     $startWeek  = $anchor->copy()->startOfWeek(Carbon::MONDAY)->startOfDay();
            //     $endWeek    = $anchor->copy()->endOfWeek(Carbon::SUNDAY)->endOfDay();
            //     $q->whereBetween($dateCol, [$startWeek, $endWeek]);
            //     break;
            case 'mingguan':
            if ($this->minggu) {
                [$year, $week] = explode('-W', $this->minggu);
                $anchor    = Carbon::now()->setISODate($year, $week);
                $startWeek = $anchor->copy()->startOfWeek(Carbon::MONDAY)->startOfDay();
                $endWeek   = $anchor->copy()->endOfWeek(Carbon::SUNDAY)->endOfDay();
                $q->whereBetween($dateCol, [$startWeek, $endWeek]);
            }
            break;

            case 'bulanan':
                $q->whereYear($dateCol, (int) $this->tahun)
                  ->whereMonth($dateCol, (int) $this->bulan);
                break;

            case 'tahunan':
                $q->whereYear($dateCol, (int) $this->tahun);
                break;
        }

        return $q;
    }

    // Data mentah untuk TABEL (biar user bisa melihat baris aslinya)
    protected function getTableData($model)
    {
        return $this->baseQuery($model)
            ->orderBy($this->dateColumn, 'desc')
            ->get();
    }

    public function getExportData(string $model): Collection
    {
        // return $this->baseQuery($model)
        //     ->get()
        //     ->groupBy(fn ($row) => $row->{$this->dateColumn}->format('Y-m-d'));

        $results = $this->baseQuery($model)->get();
        
            return $results->groupBy('id_driver')->map(function ($items) {
            // $first = $items->first();
            $driver      = $items->first()->driver;
            $vehicle     = $items->first()->vehicle;

            // $totalNetto = $items->sum(fn($item) => (($item->bruto ?? 0) - ($item->tara ?? 0)));
                $totalNetto = $items->sum(function ($item) {
                    return $item->bruto - $item->tara;
                });
            $totalRitasi = $items->sum('banyak_ritasi');

            return [
                'driver_name' => $driver->name ?? '-',
                'vehicle'     => $vehicle->jenis_kendaraan ?? '-',
                'no_polisi'   => $vehicle->no_polisi ?? '-',
                'ritasi'      => $totalRitasi,
                'netto'       => $totalNetto,
                'avg_per_day' => round($totalNetto / max($items->count(), 1), 2),
                'lokasi'      => $vehicle->uptd->nama_uptd ?? '-',
                'keterangan'  => $items->first()->keterangan ?? '-',
                'rows'        => $items, // menyertakan baris asli jika dibutuhkan
            ];
        })->values();
    }

    public function getFilteredData($model): Collection
    {
        return $this->getExportData($model);
    }
    
    public function applyFilter()
    {
        // cukup trigger ulang render(), karena render() sudah panggil baseQuery
        if ($this->selectedTPA === 'pecuk') {
            $this->ritasiList = $this->getTableData(Ritasi::class);
        } elseif ($this->selectedTPA === 'kertawinangun') {
            $this->ritasiList = $this->getTableData(RitasiKertawinangun::class);
        } else {
            $this->ritasiList = collect();
        }

        return view('livewire.tpa.data-tpa', [
            'ritasiList'   => $this->ritasiList,
            'selectedTPA'  => $this->selectedTPA,
            'filterType'   => $this->filterType,
        ]);
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        Log::info('Selected TPA: ' . $this->selectedTPA);

        if ($this->selectedTPA === 'pecuk') {
            $this->ritasiList = $this->getTableData(Ritasi::class);
        } elseif ($this->selectedTPA === 'kertawinangun') {
            $this->ritasiList = $this->getTableData(RitasiKertawinangun::class);
        } else {
            $this->ritasiList = collect();
        }

        return view('livewire.tpa.data-tpa', [
            'ritasiList'   => $this->ritasiList,
            'selectedTPA'  => $this->selectedTPA,
            'filterType'   => $this->filterType,
            'tanggal'      => $this->tanggal,
            'bulan'        => $this->bulan,
            'tahun'        => $this->tahun,
        ]);

    }
}

    // Data untuk EXPORT (contoh: dikelompokkan per driver)
    // protected function getExportData($model): Collection
    // {
    //     $results = $this->baseQuery($model)->get();

    //     return $results->groupBy('id_driver')->map(function ($items) {
    //         $driver      = $items->first()->driver;
    //         $vehicle     = $items->first()->vehicle;
    //         $totalNetto  = $items->sum(fn($item) => ($item->bruto ?? 0) - ($item->tara ?? 0));
    //         $totalRitasi = $items->sum('banyak_ritasi');

    //         return [
    //             'driver_name' => $driver->name ?? '-',
    //             'vehicle'     => $vehicle->jenis_kendaraan ?? '-',
    //             'no_polisi'   => $vehicle->no_polisi ?? '-',
    //             'ritasi'      => $totalRitasi,
    //             'netto'       => $totalNetto,
    //             'avg_per_day' => round($totalNetto / max($items->count(), 1), 2),
    //             'lokasi'      => $vehicle->uptd->nama_uptd ?? '-',
    //             'keterangan'  => $items->first()->keterangan ?? '-',
    //         ];
    //     })->values();
    // }

    // public function getFilteredData($model): Collection
    // {
    //     $query = $model::query();

    //     if ($this->filterType === 'harian') {
    //         $query->whereDate('created_at', $this->tanggal);
    //     }

    //     if ($this->filterType === 'mingguan') {
    //         $startOfWeek = Carbon::parse($this->tanggal)->startOfWeek();
    //         $endOfWeek = Carbon::parse($this->tanggal)->endOfWeek();

    //         $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
    //     }

    //     if ($this->filterType === 'bulanan') {
    //         $query->whereMonth('created_at', $this->bulan)
    //             ->whereYear('created_at', $this->tahun);
    //     }

    //     if ($this->filterType === 'tahunan') {
    //         $query->whereYear('created_at', $this->tahun);
    //     }

    //     $results = $query->get();

    //     return $results->groupBy('id_driver')->map(function ($items) {
    //         $driver = $items->first()->driver;
    //         $vehicle = $items->first()->vehicle;
    //         $totalNetto = $items->sum(function ($item) {
    //             return $item->bruto - $item->tara;
    //         });
    //         $totalRitasi = $items->sum('banyak_ritasi');

    //         return [
    //             'driver_name' => $driver->name ?? '-',
    //             'vehicle' => $vehicle->jenis_kendaraan ?? '-',
    //             'no_polisi' => $vehicle->no_polisi ?? '-',
    //             'ritasi' => $totalRitasi,
    //             'netto' => $totalNetto,
    //             'avg_per_day' => round($totalNetto / max($items->count(), 1), 2),
    //             'lokasi' => $vehicle->uptd->nama_uptd ?? '-',
    //             'keterangan' => $items->first()->keterangan ?? '-',
    //         ];
    //     })->values(); 
    // }


    //     $ritasiList = collect();

    // if ($this->selectedTPA === 'pecuk') {
    //     $this->ritasiList = Ritasi::with(['driver', 'vehicle.uptd'])
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    // } elseif ($this->selectedTPA === 'kertawinangun') {
    //     $this->ritasiList = RitasiKertawinangun::with(['driver', 'vehicle.uptd'])
    //         ->orderBy('created_at', 'desc')
    //         ->get();
    // }

    //   return view('livewire.tpa.data-tpa', [
    //     'ritasiList'   => $ritasiList,
    //     'selectedTPA'  => $this->selectedTPA,
    //     'filterType'   => $this->filterType,
    // ]);



    // } else {
    //     $this->ritasiList = collect();
    // }