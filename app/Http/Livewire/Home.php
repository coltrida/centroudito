<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Livewire\Component;
use function view;

class Home extends Component
{
    public function render(UserService $userService)
    {
        $parametri = [];
        $nomeVista = 'livewire.home.home-admin';
        $parametri = [
            'audioprotesisti' => [],
            'filiali' => [],
            'amministrativi' => []
        ];
        if (isset($userService->getUser()->name)){
            if ($userService->isAdmin()){
                $nomeVista = 'livewire.home.home-admin';
                $parametri = [
                    'audioprotesisti' => $userService->getAudioprotesisti(),
                    'filiali' => $userService->getFiliali(),
                    'amministrativi' => $userService->getAmministrazione()
                ];
            } elseif ($userService->isAudio()){
                $nomeVista = 'livewire.home.home-audio';
                $parametri = [
                    'proveInCorso' => $userService->proveInCorso(),
                    'finalizzati' => $userService->finalizzatiDelMese(),
                ];
            } elseif ($userService->isAmministrazione()){
                $nomeVista = 'livewire.home.home-amministrazione';
            }
        }

        return view($nomeVista, $parametri);
    }
}
