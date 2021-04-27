<?php

namespace App\Http\Livewire;

use App\Services\FilialeService;
use App\Services\UserService;
use Livewire\Component;
use function session;
use function view;

class AudioDatatables extends Component
{
    public $nome;
    public $email;
    public $id_filiale;

    public function addAudioprotesista(UserService $userService)
    {
        $reques = [
            'nome' => $this->nome,
            'email' => $this->email,
            'id_filiale' => $this->id_filiale,
        ];
        if(!$userService->inserisciAudioprotesista($reques)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Audioprotesista inserito');
        }
        $this->nome = '';
        $this->email = '';
        $this->id_filiale = '';
    }

    public function remove($filialeId, FilialeService $filialeService)
    {
        if(!$filialeService->rimuovi($filialeId)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Filiale eliminata');
        }
    }

    public function render(UserService $userService)
    {
        return view('livewire.audio-datatables', [
            'audioprotesisti' => $userService->getAudioprotesisti()
        ]);
    }
}

