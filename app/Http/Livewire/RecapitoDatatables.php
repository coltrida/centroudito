<?php

namespace App\Http\Livewire;

use App\Services\RecapitoService;
use Livewire\Component;
use function session;
use function view;

class RecapitoDatatables extends Component
{
    public $nome;
    public $indirizzo;
    public $citta;
    public $provincia;

    public function aggiungi(RecapitoService $recapitoService)
    {
        $reques = [
            'nome' => $this->nome,
            'indirizzo' => $this->indirizzo,
            'citta' => $this->citta,
            'provincia' => $this->provincia,
        ];
        if(!$recapitoService->inserisci($reques)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Recapito inserito');
        }
        $this->nome = '';
        $this->indirizzo = '';
        $this->citta = '';
        $this->provincia = '';
    }

    public function remove($id, RecapitoService $recapitoService)
    {
        if(!$recapitoService->rimuovi($id)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Recapito eliminato');
        }
    }

    public function render(RecapitoService $recapitoService)
    {
        return view('livewire.recapito-datatables', [
            'recapiti' => $recapitoService->recapiti()
        ]);
    }
}
