<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoriaService;
use App\Services\FilialeService;
use App\Services\FornitoriService;
use App\Services\ListinoService;
use Illuminate\Http\Request;

class ListinoController extends Controller
{
    public function listino(ListinoService $listinoService)
    {
        $listino = $listinoService->listino();
        return view('admin.listino.index', compact('listino'));
    }

    public function aggiungiListino(FornitoriService $fornitoriService, CategoriaService $categoriaService, FilialeService $filialeService)
    {
        $fornitori = $fornitoriService->fornitori();
        $categorie = $categoriaService->lista();
        $filiali = $filialeService->lista();
        return view('admin.listino.aggiungi', compact('fornitori', 'categorie', 'filiali'));
    }

    public function salvaListino(Request $request, ListinoService $listinoService)
    {
        $listinoService->inserisci($request);
        return \Redirect::route('admin.listino');
    }

    public function eliminaListino($id, ListinoService $listinoService)
    {
        $listinoService->rimuovi($id);
        return \Redirect::route('admin.listino');
    }
}
