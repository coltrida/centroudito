<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Services\NoteService;
use Livewire\Component;

class Modalnote extends Component
{
    public $visibile = true;
    public $clientName;
    public $clientCognome;
    public $clientId;
    public $nota;

    protected $listeners = [
        'clientSelectedNote',
    ];

    public function clientSelectedNote($id)
    {
        $this->visibile = false;
        $client = Client::find($id);
        $this->clientName = $client->nome;
        $this->clientCognome = $client->cognome;
        $this->clientId = $id;
    }

    public function aggiungi(NoteService $noteService)
    {
        $noteService->inserisci($this->nota, $this->clientId);
        $this->nota = '';
    }

    public function remove($id, NoteService $noteService)
    {
        $noteService->rimuovi($id);
    }

    public function closeModal()
    {
        $this->clientId = '';
        $this->clientName = '';
        $this->visibile = true;
    }

    public function render(NoteService $noteService)
    {
        return view('livewire.modalClient.modalnote', [
            'note' => $this->clientId ? $noteService->note($this->clientId) : []
        ]);
    }
}
