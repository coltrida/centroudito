<?php

namespace App\Http\Livewire;

use App\Services\ClientService;
use App\Services\FatturaService;
use App\Services\ProvaService;
use Livewire\Component;
use function dd;
use function session;

class Fattura extends Component
{
    public $visibile = true;
    public $clientId;
    public $prova;
    public $codfisc;
    public $totFattura;
    public $rate;
    public $acconto;

    protected $listeners = [
        'clientFattura',
    ];

    public function clientFattura($idProva, ProvaService $provaService)
    {
        $this->visibile = false;
        $this->prova = $provaService->infoprova($idProva);
        $this->codfisc = $this->prova->client->codfisc;
        $this->totFattura = $this->prova->tot;
    }

    public function closeModal()
    {
        $this->clientId = '';
        $this->visibile = true;
    }

    public function fattura(ClientService $clientService, FatturaService $fatturaService)
    {
        if($clientService->inserisciCodfisc($this->prova->client->id, $this->codfisc)){
            if(!$fatturaService->crea([
                'prova' => $this->prova,
                'totFattura' => $this->totFattura,
                'rate' => $this->rate,
                'acconto' => $this->acconto])){
                session()->flash('message', 'Errore di creazione Fattura');
            } else {
                $this->visibile = true;
                $this->clientId = null;
                $this->prova = null;
                $this->codfisc = null;
                $this->totFattura = null;
                $this->rate = null;
                $this->acconto = null;
                session()->flash('message', 'Fattura creata');
            }
        }
    }

    public function render()
    {
        return view('livewire.fattura.fattura');
    }
}
