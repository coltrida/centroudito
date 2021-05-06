<?php

namespace App\Http\Livewire;


use App\Services\FatturaService;
use Livewire\Component;

class Modalfattura extends Component
{
    public $visibile = true;
    public $listaFatture = [];

    protected $listeners = [
        'listaFatture'
    ];

    public function closeModal()
    {
        $this->clientId = '';
        $this->clientName = '';
        $this->visibile = true;
    }

    public function listaFatture($id, FatturaService $fatturaService)
    {
        $this->visibile = false;
        $this->listaFatture = $fatturaService->listaFattureFromClient($id);
    }

    public function render()
    {
        return view('livewire.modalClient.modalfattura');
    }
}
