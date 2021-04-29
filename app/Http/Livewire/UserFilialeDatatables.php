<?php

namespace App\Http\Livewire;

use App\Services\FilialeService;
use App\Services\UserService;
use Livewire\Component;
use function dd;

class UserFilialeDatatables extends Component
{
    public $filialeSel_id;
    public $personale = [];

    public function associa(FilialeService $filialeService)
    {
        $filialeService->associa($this->filialeSel_id, $this->personale);
        $this->filialeSel_id = '';
        $this->personale = [];
    }

    public function dissocia($id, FilialeService $filialeService)
    {
        $filialeService->dissocia($id);
    }

    public function render(UserService $userService, FilialeService $filialeService)
    {
        return view('livewire.user-filiale-datatables', [
            'audioprotesisti' => $userService->getAudioprotesisti(),
            'amministrazione' => $userService->getAmministrazione(),
            'filiali' => $filialeService->filiali()
        ]);
    }
}
