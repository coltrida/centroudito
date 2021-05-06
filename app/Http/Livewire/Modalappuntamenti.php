<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Services\AppuntamentoService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function dd;
use function view;

class Modalappuntamenti extends Component
{
    public $visibile = true;
    public $clientName;
    public $clientCognome;
    public $clientId;
    public $filialeId;
    public $recapitoId;
    public $giorno;
    public $ore;
    public $note;

    protected $listeners = [
        'clientSelectedAppuntamenti',
    ];

    public function clientSelectedAppuntamenti($id)
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
            'giorno' => $this->giorno,
            'ore' => $this->ore,
            'note' => $this->note,
            'client_id' => $this->clientId,
            'user_id' => Auth::id(),
            'filiale_id' => $this->filialeId,
            'recapito_id' => $this->recapitoId,
        ];
        $appuntamentoService->inserisci($reques);
        $this->giorno = '';
        $this->ore = '';
        $this->note = '';
        $this->filialeId = '';
        $this->recapitoId = '';
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

    public function render(AppuntamentoService $appuntamentoService, UserService $userService)
    {
        //dd($userService->getFiliali());
        return view('livewire.modalClient.modalappuntamenti', [
            'appuntamenti' => $this->clientId ? $appuntamentoService->appuntamenti($this->clientId) : [],
            'filiali' => $userService->getFiliali(),
            'recapiti' => $userService->getRecapitiOfUser(),
        ]);
    }
}
