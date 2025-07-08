<?php

namespace App\Livewire\Tpa;

use Livewire\Component;
use Livewire\Attributes;
use Illuminate\Support\Facades\Auth;

class InputRitasi extends Component
{
    public $tpa;

    public function mount($tpa)
    {
        // Validasi agar hanya tpa pecuk atau kertawinangun
        if (!in_array($tpa, ['pecuk', 'kertawinangun'])) {
            abort(404);
        }

        $this->tpa = $tpa;

        $role = Auth::user()->role;

        if (
            ($role === 'operator_pecuk' && $tpa !== 'pecuk') ||
            ($role === 'operator_kertawinangun' && $tpa !== 'kertawinangun')
        ) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    #[Attributes\Layout('layouts.content.content')]
    public function render()
    {
        return view('livewire.tpa.input-ritasi');
    }
}
