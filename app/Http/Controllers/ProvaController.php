<?php

namespace App\Http\Controllers;

use App\Services\FilialeService;
use App\Services\ProvaService;

class ProvaController extends Controller
{
    public function prova($idClient)
    {
        return view('prove.index', compact('idClient'));
    }

    public function listaProve($idFiliale, ProvaService $provaService)
    {
        $filiale = $provaService->listaByFiliale($idFiliale);
        $prove = $filiale->prove;
        return view('prove.listaProve', compact('filiale', 'prove'));
    }
}
