<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Services\AppuntamentoService;
use App\Services\ClientService;
use App\Services\FornitoreService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
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

    public function aggiungi(AppuntamentoService $appuntamentoService)
    {
        $reques = [
            'client_id' => $this->clientId,
            'stato' => $this->stato,
            'user_id' => Auth::id(),
            'filiale_id' => $this->filialeId,
        ];
        $appuntamentoService->inserisci($reques);
        $this->filialeId = '';
        $this->stato = '';
    }

    public function remove($id, AppuntamentoService $appuntamentoService)
    {
        $appuntamentoService->rimuovi($id);
    }

    public function closeModal()
    {
        $this->clientId = '';
        $this->clientName = '';
        $this->visibile = true;
    }

    public function render(ClientService $clientService, FornitoreService $fornitoreService)
    {
        //dd($userService->getFiliali());
        return view('livewire.modalClient.modalprova', [
            'prove' => $this->clientId ? $clientService->getProve($this->clientId) : [],
            'fornitori' => $fornitoreService->fornitori(),
            'listino' => $this->fornitoreId ? $fornitoreService->listinoFromFornitore($this->fornitoreId) : [],
        ]);
    }
}

