<?php

namespace App\Exports;

use App\Models\Ritasi;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RitasiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                $item['driver_name'],
                $item['vehicle'],
                $item['no_polisi'],
                $item['ritasi'],
                $item['netto'],
                $item['avg_per_day'],
                $item['lokasi'],
                $item['keterangan'],
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Supir',
            'Jenis Kendaraan',
            'Nomor Polisi',
            'Jumlah Ritasi',
            'Netto (Kg)',
            'Rata-rata / Hari (Kg)',
            'Lokasi / Wilayah',
            'Keterangan',
        ];
    }
}
    // public function collection()
    // {
    //     return Ritasi::all();
    // }
// }
