<?php

namespace App\Http\Livewire;

use App\Services\CategoriaService;
use App\Services\ClientService;
use App\Services\FornitoriService;
use App\Services\ListinoService;
use App\Services\MarketingService;
use App\Services\ProductService;
use App\Services\ProvaService;
use Livewire\Component;

class Prova extends Component
{
    public $showDiv = false;
    public $showEleInProva = false;
    public $cliente;
    public $filiale_id;
    public $recapito_id;
    public $marketing_id;
    public $mercato;
    public $canali;
    public $fornitori;
    public $categorie;
    public $prodotti;
    public $productsInFiliale;
    public $eleInProva;
    public $prodottiSelezionati = [];
    public $prezzi = [];
    public $tot;

    public $idFornitore = null;
    public $idCategoria = null;

    protected $listeners = ['fornitoreSelezionato', 'categoriaSelezionata', 'caricaProdottiMagazzino'];

    public function mount($idClient, ClientService $clientService, ProvaService $provaService,
                          MarketingService $marketingService, FornitoriService $fornitoriService,
                          CategoriaService $categoriaService)
    {
        $this->cliente = $clientService->cliente($idClient);
        $this->canali = $marketingService->canali();
        $this->fornitori = $fornitoriService->fornitori();
        $this->categorie = $categoriaService->lista();
        $this->prodotti = [];
        $this->tot = 0;
        $this->productsInFiliale = [];
        $this->eleInProva = $provaService->eleInProva($idClient);
        $this->prodottiSelezionati = [];
        $this->prezzi = [];
        $this->mercato = '';
        $this->filiale_id = $this->cliente->filiale_id;
        $this->recapito_id = $this->cliente->recapito_id;
        $this->marketing_id = $this->cliente->marketing_id;
    }

    public function render()
    {
        return view('livewire.prova');
    }

    public function fornitoreSelezionato($idFornitore, ListinoService $listinoService)
    {
      //  $this->idFornitore = $idFornitore;
        $this->caricaProdotti($listinoService);
    }

    public function categoriaSelezionata($idCategoria, ListinoService $listinoService)
    {
     //   $this->idCategoria = $idCategoria;
        $this->caricaProdotti($listinoService);
    }

    private function caricaProdotti($listinoService)
    {
        if ($this->idCategoria && $this->idFornitore){
            $this->prodotti = $listinoService->listinoFromFornitoreCategoria($this->idFornitore, $this->idCategoria);
        }
    }

    public function caricaProdottiMagazzino($idListino, ProductService $productService)
    {
        $this->productsInFiliale = $productService->listaSpecificoProdottoInFiliale($idListino, $this->cliente->filiale_id);
    }

    public function aggiungiProddottiAllaProva(ProductService $productService, ProvaService $provaService)
    {
        $dati = [
            'user_id' => $this->cliente->user_id,
            'client_id' => $this->cliente->id,
            'prodotti' => $this->prodottiSelezionati
        ];
        $productService->switchInProva($dati);
        $this->eleInProva = $provaService->eleInProva($this->cliente->id);
        $this->prezzi = [];
        $this->tot = 0;
        foreach ($this->eleInProva as $item){
            array_push($this->prezzi, $item->listino->prezzolistino);
            $this->tot += $item->listino->prezzolistino;
        }

        $this->productsInFiliale = $this->productsInFiliale->filter(function($item) {
            return (!in_array($item->id, $this->prodottiSelezionati));
        });

        $this->showEleInProva = true;
        $this->prodottiSelezionati = [];
    }

    public function aggiornaSomma()
    {
        $this->tot = 0;
       foreach ($this->prezzi as $item){
           $this->tot += $item;
       }
    }

    public function salvaProva(ProvaService $provaService)
    {
        $request = new \Illuminate\Http\Request();
        $request->merge([
            'client_id' => $this->cliente->id,
            'user_id' => $this->cliente->user_id,
            'filiale_id' => $this->filiale_id,
            'prezzi' => $this->prezzi,
            'mercato' => $this->mercato,
            'marketing_id' => $this->marketing_id,
            'prodotti' => $this->eleInProva,
            'tot' => $this->tot
        ]);
        $provaService->nuova($request);
        $this->eleInProva = [];
        $this->tot = null;
        $this->idFornitore = null;
        $this->idCategoria = null;
        $this->prodotti = [];
        $this->showEleInProva = false;
        $this->emit('creazioneNuovaProva');
    }

    public function eliminaProdottoDallaProva($id, ProductService $productService, ProvaService $provaService)
    {
        $productService->switchRimuoviDallaProva($id);
        $this->eleInProva = $provaService->eleInProva($this->cliente->id);
        $this->tot = 0;
        $this->idFornitore = null;
        $this->idCategoria = null;
        $this->prodotti = [];
        $this->prezzi = [];
        foreach ($this->eleInProva as $item){
            array_push($this->prezzi, $item->listino->prezzolistino);
            $this->tot += $item->listino->prezzolistino;
        }
    }

}
