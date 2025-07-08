<div class="p-6 bg-white shadow rounded-lg">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-semibold">
            Input Ritasi - TPA {{ ucfirst($tpa) }}
        </h2>

        <a href="{{ route('data-tpa') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">
            ← Kembali
        </a>
    </div>

    @if ($tpa === 'pecuk')
        @livewire('tpa.ritasi-pecuk-form')
    @elseif ($tpa === 'kertawinangun')
        @livewire('tpa.ritasi-kertawinangun-form')
    @endif
</div>

