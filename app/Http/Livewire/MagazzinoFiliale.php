<?php

namespace App\Http\Livewire;

use App\Services\FilialeService;
use App\Services\FornitoreService;
use App\Services\ProductService;
use Livewire\Component;
use function session;

class MagazzinoFiliale extends Component
{
    public $ricerca;
    public $idFiliale;
    public $idListino;
    public $idFornitore;
    public $quantita;

    public function richiedi(ProductService $productService)
    {
        $reques = [
            'stato' => 'richiesto',
            'quantita' => $this->quantita,
            'filiale_id' => $this->idFiliale,
            'listino_id' => $this->idListino,
            'fornitore_id' => $this->idFornitore,
        ];

        if(!$productService->richiedi($reques)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Prodotto richiesto');
        }
        $this->idListino = '';
        $this->idFornitore = '';
        $this->quantita = '';
    }

    public function remove($id, ProductService $productService)
    {
        if(!$productService->rimuovi($id)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Elemento eliminato');
        }
    }

    public function arrivato($id, ProductService $productService)
    {
        if(!$productService->arrivato($id)){
            session()->flash('message', 'Errore di modifica');
        } else {
            session()->flash('message', 'Elemento caricato in magazzino');
        }
    }

    public function render(ProductService $productService, FornitoreService $fornitoreService, FilialeService $filialeService)
    {
        return view('livewire.magazzino.magazzino-filiale', [
            'prodottiRichiesti' => $productService->prodottiRichiesti($this->idFiliale, $this->ricerca),
            'prodottiInFiliale' => $productService->prodottiInFiliale($this->idFiliale, $this->ricerca),
            'prodottiInArrivo' => $productService->prodottiInArrivo($this->idFiliale, $this->ricerca),
            'fornitori' => $fornitoreService->fornitori(),
            'listino' => $this->idFornitore ? $fornitoreService->listinoFromFornitore($this->idFornitore) : [],
            'magazzino' => $filialeService->nomeFiliale($this->idFiliale)
        ]);
    }
}
