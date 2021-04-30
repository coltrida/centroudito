<?php

namespace App\Http\Livewire;

use App\Services\FornitoreService;
use App\Services\ListinoService;
use App\Services\ProductService;
use Livewire\Component;
use function session;

class MagazzinoDatatable extends Component
{
    public $idFiliale;
    public $idListino;
    public $idFornitore;
    public $ricerca;
    public $matricola;
    public $stato;

    public function aggiungi(ProductService $productService)
    {
        $reques = [
            'matricola' => $this->matricola,
            'stato' => $this->stato,
            'filiale_id' => $this->idFiliale,
            'listino_id' => $this->idListino,
            'fornitore_id' => $this->idFornitore,
        ];
        if(!$productService->inserisci($reques)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Prodotto inserito');
        }
        $this->matricola = '';
        $this->stato = '';
        $this->idListino = '';
        $this->idFornitore = '';
    }

    public function remove($id, ProductService $productService)
    {
        if(!$productService->rimuovi($id)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Elemento eliminato');
        }
    }

    public function render(ProductService $productService, FornitoreService $fornitoreService, ListinoService $listinoService)
    {
        return view('livewire.magazzino-datatable', [
            'products' => $productService->products($this->idFiliale, $this->ricerca),
            'fornitori' => $fornitoreService->fornitori(),
            'listino' => $listinoService->listino(),
        ]);
    }
}
