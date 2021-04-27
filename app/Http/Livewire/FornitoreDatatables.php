<?php

namespace App\Http\Livewire;

use App\Services\FornitoreService;
use Livewire\Component;
use function session;
use function view;

class FornitoreDatatables extends Component
{
    public $nome;
    public $indirizzo;
    public $citta;
    public $cap;
    public $provincia;
    public $telefono;
    public $email;
    public $pec;
    public $codunivoco;

    public function aggiungi(FornitoreService $fornitoreService)
    {
        $reques = [
            'nome' => $this->nome,
            'indirizzo' => $this->indirizzo,
            'citta' => $this->citta,
            'cap' => $this->cap,
            'telefono' => $this->telefono,
            'provincia' => $this->provincia,
            'pec' => $this->pec,
            'email' => $this->email,
            'codunivoco' => $this->codunivoco,
        ];
        if(!$fornitoreService->inserisci($reques)){
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
        $this->pec = '';
        $this->email = '';
        $this->codunivoco = '';
    }

    public function remove($id, FornitoreService $fornitoreService)
    {
        if(!$fornitoreService->rimuovi($id)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Filiale eliminata');
        }
    }

    public function render(FornitoreService $fornitoreService)
    {
        return view('livewire.fornitore-datatables', [
            'fornitori' => $fornitoreService->fornitori()
        ]);
    }
}

