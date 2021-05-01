<?php

namespace App\Http\Livewire;

use App\Services\FilialeService;
use Livewire\Component;
use function session;

class FilialeDatatables extends Component
{
    public $nome;
    public $indirizzo;
    public $citta;
    public $cap;
    public $provincia;
    public $telefono;

    public function addFiliale(FilialeService $filialeService)
    {
        $reques = [
            'nome' => $this->nome,
            'indirizzo' => $this->indirizzo,
            'citta' => $this->citta,
            'cap' => $this->cap,
            'telefono' => $this->telefono,
            'provincia' => $this->provincia,
        ];
        if(!$filialeService->inserisci($reques)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Filiale inserita');
        }
        $this->nome = '';
        $this->indirizzo = '';
        $this->citta = '';
        $this->cap = '';
        $this->telefono = '';
        $this->provincia = '';
    }

    public function remove($filialeId, FilialeService $filialeService)
    {
        if(!$filialeService->rimuovi($filialeId)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Filiale eliminata');
        }
    }

    public function render(FilialeService $filialeService)
    {
        return view('livewire.strutture.filiale-datatables', [
            'filiali' => $filialeService->filiali()
        ]);
    }
}
