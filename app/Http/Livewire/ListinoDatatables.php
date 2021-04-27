<?php

namespace App\Http\Livewire;

use App\Services\FilialeService;
use App\Services\FornitoreService;
use App\Services\ListinoService;
use Livewire\Component;
use function session;
use function throw_if;
use function view;

class ListinoDatatables extends Component
{
    public $categoria;
    public $nome;
    public $costo;
    public $prezzolistino;
    public $iva;
    public $fornitore_id;
    public $ricerca;

    public function aggiungi(ListinoService $listinoService)
    {
        $reques = [
            'categoria' => $this->categoria,
            'nome' => $this->nome,
            'costo' => $this->costo,
            'prezzolistino' => $this->prezzolistino,
            'iva' => $this->iva,
            'fornitore_id' => $this->fornitore_id,
        ];
        if(!$listinoService->inserisci($reques)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Prodotto inserito');
        }
        $this->categoria = '';
        $this->nome = '';
        $this->costo = '';
        $this->prezzolistino = '';
        $this->iva = '';
        $this->fornitore_id = '';
    }

    public function remove($id, ListinoService $listinoService)
    {
        if(!$listinoService->rimuovi($id)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Elemento eliminato');
        }
    }

    public function render(ListinoService $listinoService, FornitoreService $fornitoreService)
    {
        return view('livewire.listino-datatables', [
            'listino' => $listinoService->listino($this->ricerca),
            'fornitori' => $fornitoreService->fornitori()
        ]);
    }
}
