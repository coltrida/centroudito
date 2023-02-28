<?php

namespace App\Http\Livewire;

use App\Services\ProvaService;
use Livewire\Component;

class StoricoProve extends Component
{
    public $storicoProve = [];
    public $idClient;
    public $prodottiProva = [];
    public $provaDaFatturare;
    public $totFatturaReale;
    public $acconto;
    public $rate;

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

    public function reso(\App\Models\Prova $prova, ProvaService $provaService)
    {
        $provaService->reso($prova->id);
        $this->caricaProvePassate($provaService);
    }

    public function provaSelezionataPerFattura(\App\Models\Prova $prova)
    {
        $this->provaDaFatturare = $prova;
        $this->totFatturaReale = $this->provaDaFatturare->tot;
    }

    public function fattura(ProvaService $provaService)
    {
        $request = new \Illuminate\Http\Request();
        $request->merge([
            'id' => $this->provaDaFatturare->id,
            'acconto' => $this->acconto,
            'rate' => $this->rate,
            'product' => $this->provaDaFatturare->product,
            'client_id' => $this->idClient,
            'totFatturaReale' => $this->totFatturaReale
        ]);
        $provaService->salvaFattura($request);
        $this->caricaProvePassate($provaService);
    }

    public function render()
    {
        return view('livewire.storico-prove');
    }
}
