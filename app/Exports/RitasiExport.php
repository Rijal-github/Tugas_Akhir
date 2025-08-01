<?php

namespace App\Exports;

use App\Models\Ritasi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RitasiExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;
    protected $filterType;
    protected $tanggal;
    protected $bulan;
    protected $tahun;
    protected $selectedTPA;

    public function __construct(
        Collection $data,
        string $filterType,
        ?string $tanggal,
        ?string $bulan,
        ?string $tahun,
        string $selectedTPA
    ) {
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
            'harian' => 'exports.ritasi.harian',
            'mingguan' => 'exports.ritasi.mingguan',
            'bulanan' => 'exports.ritasi.bulanan',
            'tahunan' => 'exports.ritasi.tahunan',
            default => 'exports.ritasi.harian',
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
    // public function collection()
    // {
    //     return $this->data->map(function ($item) {
    //         return [
    //             $item['driver_name'],
    //             $item['vehicle'],
    //             $item['no_polisi'],
    //             $item['ritasi'],
    //             $item['netto'],
    //             $item['avg_per_day'],
    //             $item['lokasi'],
    //             $item['keterangan'],
    //         ];
    //     });
    // }

    // public function headings(): array
    // {
    //     return [
    //         'Nama Supir',
    //         'Jenis Kendaraan',
    //         'Nomor Polisi',
    //         'Jumlah Ritasi',
    //         'Netto (Kg)',
    //         'Rata-rata / Hari (Kg)',
    //         'Lokasi / Wilayah',
    //         'Keterangan',
    //     ];
    // }

    // public function collection()
    // {
    //     return Ritasi::all();
    // }
// }
