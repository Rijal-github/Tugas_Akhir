<?php

namespace App\Livewire\Tps;

use Livewire\Component;
use App\Models\Tps;
use App\Models\Uptd;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DataTpsExport extends Component
{
    public $selectedUptd = null;

    public function export()
    {
        if (!$this->selectedUptd) {
            session()->flash('error', 'Silakan pilih UPTD terlebih dahulu.');
            return;
        }

        $data = Tps::with('uptd')
        ->where('id_uptd', (int) $this->selectedUptd)
        ->select('id_uptd', 'jenis_tps', 'latitude', 'longitude')
        ->get();

        // stream response csv
        $response = new StreamedResponse(function () use ($data) {
            $handle = fopen('php://output', 'w');

            // header CSV
             fputcsv($handle, ['Nama UPTD', 'Jenis TPS', 'Latitude', 'Longitude'], ';');
        
            foreach ($data as $row) {
                fputcsv($handle, [
                    $row->uptd->nama_uptd ?? '-', // relasi ke nama uptd
                    $row->jenis_tps,
                    $row->latitude,
                    $row->longitude
                ],';');
            }

            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="data_tps.csv"');

        return $response;
    }
    public function render()
    {
        $uptds = Uptd::all();
        return view('livewire.tps.data-tps-export', compact('uptds'));
    }
}
