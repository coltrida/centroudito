<?php

namespace App\Http\Livewire;

use App\Services\FilialeService;
use App\Services\UserService;
use Livewire\Component;
use function config;
use function session;
use function view;

class AmministrazioneDatatables extends Component
{
    public $nome;
    public $email;
    public $id_filiale;

    public function addAmministrazione(UserService $userService)
    {
        $reques = [
            'nome' => $this->nome,
            'email' => $this->email,
            'id_filiale' => $this->id_filiale,
            'ruolo' => config('enum.ruoli.segreteria'),
        ];
        if(!$userService->inserisci($reques)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Amministrazione inserita');
        }
        $this->nome = '';
        $this->email = '';
        $this->id_filiale = '';
    }

    public function remove($id, UserService $userService)
    {
        if(!$userService->rimuovi($id)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Amministrazione eliminata');
        }
    }

    public function render(UserService $userService, FilialeService $filialeService)
    {
        return view('livewire.amministrazione-datatables', [
            'amministrazione' => $userService->getAmministrazione(),
            'filiali' => $filialeService->filiali()
        ]);
    }
}

