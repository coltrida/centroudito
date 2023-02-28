<?php

namespace App\Http\Livewire;

use App\Services\CategoriaService;
use App\Services\FornitoriService;
use App\Services\ListinoService;
use App\Services\ProductService;
use Livewire\Component;

class Magazzino extends Component
{
    public $prodottiPresenti;
/*    public $prodottiRichiesti;*/
    public $prodottiInArrivo;
    public $filiale;
    public $prodotti = [];
    public $categorie = [];
    public $fornitori = [];
    public $idFornitore;
    public $idCategoria;
    public $idListino;
    public $quantita;

    public function mount($idFiliale,
                          ProductService $productService,
                          CategoriaService $categoriaService,
                          FornitoriService $fornitoriService)
    {
        $this->filiale = $productService->presenti($idFiliale);
        $this->prodottiPresenti = $this->filiale->products;

        $this->prodottiInArrivo = $productService->inArrivo($idFiliale);
        $this->fornitori = $fornitoriService->fornitori();
        $this->categorie = $categoriaService->lista();
    }

    public function getProdottirichiestiProperty(ProductService $productService)
    {
        return $productService->richiesti($this->filiale->id);
    }

    public function fornitoreSelezionato($idFornitore, ListinoService $listinoService)
    {
        $this->idFornitore = $idFornitore;
        $this->caricaProdotti($listinoService);
    }

    public function categoriaSelezionata($idCategoria, ListinoService $listinoService)
    {
        $this->idCategoria = $idCategoria;
        $this->caricaProdotti($listinoService);
    }

    public function prodottoSelezionato($idListino)
    {
        $this->idListino = $idListino;
    }

    private function caricaProdotti(ListinoService $listinoService)
    {
        if ($this->idCategoria && $this->idFornitore){
            $this->prodotti = $listinoService->listinoFromFornitoreCategoria($this->idFornitore, $this->idCategoria);
        }
    }

    public function richiestaProdotti(ProductService $productService)
    {
        $request = new \Illuminate\Http\Request();
        $request->merge([
            'filiale_id' => $this->filiale->id,
            'listino_id' => $this->idListino,
            'quantita' => $this->quantita,
        ]);
        $productService->richiestaProdotti($request);
    }

    public function render()
    {
        return view('livewire.magazzino');
    }
}
