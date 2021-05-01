<?php

namespace App\Http\Livewire;

use App\Services\FilialeService;
use App\Services\UserService;
use Livewire\Component;
use function config;
use function session;
use function view;

class AudioDatatables extends Component
{
    public $nome;
    public $email;
    public $filiale_id;

    public function addAudioprotesista(UserService $userService)
    {
        $reques = [
            'nome' => $this->nome,
            'email' => $this->email,
            'filiale_id' => $this->filiale_id,
            'ruolo' => config('enum.ruoli.audio'),
        ];
        if(!$userService->inserisci($reques)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Audioprotesista inserito');
        }
        $this->nome = '';
        $this->email = '';
        $this->filiale_id = '';
    }

    public function remove($id, UserService $userService)
    {
        if(!$userService->rimuovi($id)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Audioprotesista eliminato');
        }
    }

    public function render(UserService $userService, FilialeService $filialeService)
    {
        return view('livewire.personale.audio-datatables', [
            'audioprotesisti' => $userService->getAudioprotesisti(),
            'filiali' => $filialeService->filiali()
        ]);
    }
}

