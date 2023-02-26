<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FilialeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class FilialeController extends Controller
{
    public function filiali(FilialeService $filialeService)
    {
        $filiali = $filialeService->lista();
        return view('admin.filiali.index', compact('filiali'));
    }

    public function aggiungiFiliale()
    {
        return view('admin.filiali.aggiungi');
    }

    public function salvaFiliale(Request $request, FilialeService $filialeService)
    {
        $filialeService->aggiungi($request);
        return \Redirect::route('admin.filiali');
    }

    public function eliminaFiliale($id, FilialeService $filialeService)
    {
        $filialeService->elimina($id);
        return \Redirect::route('admin.filiali');
    }

    public function listaFilialiAudio($id, FilialeService $filialeService)
    {
        return $filialeService->filialiAudio($id);
    }

    public function associaFilialeAudio(FilialeService $filialeService, UserService $userService)
    {
        $associazioni = $filialeService->associazioni();
        $utenti = $userService->lista();
        return view('admin.filiali.associazioniUtenti', compact('associazioni', 'utenti'));
    }

    public function eseguiAssociaFilialeAudio(Request $request, FilialeService $filialeService)
    {
        $filialeService->aggiungiAssociazione($request);
        return \Redirect::back();
    }

    public function eliminaAssociazione($id, FilialeService $filialeService)
    {
        $filialeService->eliminaAssociazione($id);
        return \Redirect::back();
    }
}
