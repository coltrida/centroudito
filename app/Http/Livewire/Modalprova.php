<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Models\Ddt;
use App\Services\AppuntamentoService;
use App\Services\ClientService;
use App\Services\FornitoreService;
use App\Services\ProvaService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function array_push;
use function array_slice;
use function dd;
use function json_decode;
use function throw_if;
use function view;

class Modalprova extends Component
{
    public $visibile = true;
    public $clientName;
    public $clientCognome;
    public $clientId;
    public $filialeId;
    public $fornitoreId;
    public $stato = 'inProva';
    public $prodotti = [];
    public $product;
    public $importo;
    public $orecchio;
    public $totale;

    protected $listeners = [
        'clientSelectedProva',
    ];

    public function clientSelectedProva($id)
    {
        $this->visibile = false;
        $client = Client::find($id);
        $this->clientName = $client->nome;
        $this->clientCognome = $client->cognome;
        $this->clientId = $id;
    }

    public function aggiungi(ProvaService $provaService)
    {
        $reques = [
            'client_id' => $this->clientId,
            'stato' => $this->stato,
            'user_id' => Auth::id(),
            'filiale_id' => $this->filialeId,
            'tot' => $this->totale,
            'prodotti' => $this->prodotti,
        ];
        $provaService->inserisci($reques);
        $this->filialeId = '';
        $this->stato = '';
        $this->totale = '';
        $this->prodotti = [];
    }

    public function aggiungiAllaProva($product)
    {
        $product['prezzoProposto'] = $this->importo;
        array_push($this->prodotti, $product);
        //dd($this->prodotti);
        $this->totale += $this->importo;
    }

    public function remove($id, ProvaService $provaService)
    {
        $provaService->rimuovi($id);
    }

    public function removeFromProva($id,$importo)
    {
        $this->totale -= $importo;
        array_splice($this->prodotti, $id, 1);
    }

    public function closeModal()
    {
        $this->clientId = '';
        $this->clientName = '';
        $this->visibile = true;
    }

    public function scegliProdotto($value)
    {

        $this->importo = $value != '' ? json_decode($value)->listino->prezzolistino : '';
    }

    public function render(ClientService $clientService, FornitoreService $fornitoreService)
    {
        //dd($userService->getFiliali());
        return view('livewire.modalClient.modalprova', [
            'prove' => $this->clientId ? $clientService->getProve($this->clientId) : [],
            'fornitori' => $fornitoreService->fornitori(),
            'prodottiInMagazzino' => $this->fornitoreId ? $fornitoreService->productFromFornitoreInFiliale($this->fornitoreId, $this->filialeId) : [],
        ]);
    }
}

