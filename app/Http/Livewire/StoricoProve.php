<?php

namespace App\Http\Livewire;

use App\Services\ProvaService;
use Livewire\Component;

class StoricoProve extends Component
{
    public $storicoProve = [];
    public $idClient;
    public $prodottiProva = [];

    protected $listeners = ['creazioneNuovaProva'];

    public function mount($idClient, ProvaService $provaService)
    {
        $this->idClient = $idClient;
        $this->caricaProvePassate($provaService);
    }

    public function creazioneNuovaProva(ProvaService $provaService)
    {
        $this->caricaProvePassate($provaService);
    }

    private function caricaProvePassate($provaService)
    {
        $this->storicoProve = $provaService->provePassate($this->idClient);
    }

    public function visualizzaProdotti(\App\Models\Prova $prova)
    {
        $this->prodottiProva = $prova->product;
    }

    public function render()
    {
        return view('livewire.storico-prove');
    }
}
