<?php

namespace App\Http\Livewire;

use App\Services\UserService;
use Livewire\Component;
use function view;

class Home extends Component
{
    public function render(UserService $userService)
    {
        $nomeVista = 'livewire.home-admin';
        if (isset($userService->getUser()->name)){
            if ($userService->isAdmin()){
                $nomeVista = 'livewire.home-admin';
            } elseif ($userService->isAudio()){
                $nomeVista = 'livewire.home-audio';
            } elseif ($userService->isAmministrazione()){
                $nomeVista = 'livewire.home-amministrazione';
            }
        }

        return view($nomeVista);
    }
}
