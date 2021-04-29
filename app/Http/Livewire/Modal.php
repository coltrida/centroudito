<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use function dd;

class Modal extends Component
{
    public $visibile = true;
    public $clientName;
    public $clientCognome;
    public $clientId;

    protected $listeners = [
        'clientSelectedRecall',
    ];

    public function clientSelectedRecall($id)
    {
        $this->visibile = false;
        $client = Client::find($id);
        $this->clientName = $client->nome;
        $this->clientCognome = $client->cognome;
        $this->clientId = $id;
    }

    public function closeModal()
    {
        $this->clientId = '';
        $this->clientName = '';
        $this->visibile = true;
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
