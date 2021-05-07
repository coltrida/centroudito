<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Livewire\Component;
use function dd;
use function session;

class AssegnaBudget extends Component
{

    public $audioId;
    public $stipendioMese = 0;
    public $provvigioni = 0;
    public $budget = 0;
    public $utile = 0;
    public $gennaio = 0;
    public $getGennaio = 0;
    public $febbraio = 0;
    public $getFebbraio = 0;
    public $marzo = 0;
    public $getMarzo = 0;
    public $aprile = 0;
    public $getAprile = 0;
    public $maggio = 0;
    public $getMaggio = 0;
    public $giugno = 0;
    public $getGiugno = 0;
    public $luglio = 0;
    public $getLuglio = 0;
    public $agosto = 0;
    public $getAgosto = 0;
    public $settembre = 0;
    public $getSettembre = 0;
    public $ottobre = 0;
    public $getOttobre = 0;
    public $novembre = 0;
    public $getNovembre = 0;
    public $dicembre = 0;
    public $getDicembre = 0;
    public $verifica = 0;
    public $modifica = 0;

    public function associa(UserService $userService)
    {
        $request = [
            'audioId' => $this->audioId,
            'stipendioMese' => $this->stipendioMese,
            'provvigioni' => $this->provvigioni,
            'budget' => $this->budget,
            'modifica' => $this->modifica,
            $this->gennaio,
            $this->febbraio,
            $this->marzo,
            $this->aprile,
            $this->maggio,
            $this->giugno,
            $this->luglio,
            $this->agosto,
            $this->settembre,
            $this->ottobre,
            $this->novembre,
            $this->dicembre
        ];
        if(!$userService->associaBudget($request)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Budget inserito');
        }

        $this->gennaio = 0;
        $this->febbraio = 0;
        $this->marzo = 0;
        $this->aprile = 0;
        $this->maggio = 0;
        $this->giugno = 0;
        $this->luglio = 0;
        $this->agosto = 0;
        $this->settembre = 0;
        $this->ottobre = 0;
        $this->novembre = 0;
        $this->dicembre = 0;

        $this->audioId = '';
        $this->stipendioMese = 0;
        $this->provvigioni = 0;
        $this->utile = 0;
        $this->budget = 0;
        $this->idUserSelezionato = 0;
        $this->modifica = 0;

    }

    public function modifica($id, UserService $userService)
    {
        $this->audioId = $id;
        $this->modifica = 1;
        $this->budget = $userService->getInfoBudget($id)->budgetAnno;
        $this->stipendioMese = $userService->getInfoBudget($id)->stipendio;
        $this->provvigioni = $userService->getInfoBudget($id)->provvigione;

        $this->gennaio = $userService->getInfoBudget($id)->gennaio;
        $this->febbraio = $userService->getInfoBudget($id)->febbraio;
        $this->marzo = $userService->getInfoBudget($id)->marzo;
        $this->aprile = $userService->getInfoBudget($id)->aprile;
        $this->maggio = $userService->getInfoBudget($id)->maggio;
        $this->giugno = $userService->getInfoBudget($id)->giugno;
        $this->luglio = $userService->getInfoBudget($id)->luglio;
        $this->agosto = $userService->getInfoBudget($id)->agosto;
        $this->settembre = $userService->getInfoBudget($id)->settembre;
        $this->ottobre = $userService->getInfoBudget($id)->ottobre;
        $this->novembre = $userService->getInfoBudget($id)->novembre;
        $this->dicembre = $userService->getInfoBudget($id)->dicembre;

        //$userService->disassociaBudget($id);

    }

    public function render(UserService $userService)
    {
        $this->utile = (int)$this->budget - ((int)$this->stipendioMese * 12) - (((int)$this->budget * (int)$this->provvigioni)/100);
        $this->getGennaio = (int)$this->gennaio != 0 ? ((int)$this->budget * (int)$this->gennaio)/100 : 0;
        $this->getFebbraio = (int)$this->febbraio != 0 ? ((int)$this->budget * (int)$this->febbraio)/100 : 0;
        $this->getMarzo = (int)$this->marzo != 0 ? ((int)$this->budget * (int)$this->marzo)/100 : 0;
        $this->getAprile = (int)$this->aprile != 0 ? ((int)$this->budget * (int)$this->aprile)/100 : 0;
        $this->getMaggio = (int)$this->maggio != 0 ? ((int)$this->budget * (int)$this->maggio)/100 : 0;
        $this->getGiugno = (int)$this->giugno != 0 ? ((int)$this->budget * (int)$this->giugno)/100 : 0;
        $this->getLuglio = (int)$this->luglio != 0 ? ((int)$this->budget * (int)$this->luglio)/100 : 0;
        $this->getAgosto = (int)$this->agosto != 0 ? ((int)$this->budget * (int)$this->agosto)/100 : 0;
        $this->getSettembre = (int)$this->settembre != 0 ? ((int)$this->budget * (int)$this->settembre)/100 : 0;
        $this->getOttobre = (int)$this->ottobre != 0 ? ((int)$this->budget * (int)$this->ottobre)/100 : 0;
        $this->getNovembre = (int)$this->novembre != 0 ? ((int)$this->budget * (int)$this->novembre)/100 : 0;
        $this->getDicembre = (int)$this->dicembre != 0 ? ((int)$this->budget * (int)$this->dicembre)/100 : 0;
        $this->verifica = $this->getGennaio + $this->getFebbraio + $this->getMarzo + $this->getAprile + $this->getMaggio + $this->getGiugno + $this->getLuglio + $this->getAgosto + $this->getSettembre + $this->getOttobre + $this->getNovembre + $this->getDicembre;
        return view('livewire.gestione.assegna-budget', [
            'audioprotesisti' => $userService->getAudioprotesisti()
        ]);
    }
}
