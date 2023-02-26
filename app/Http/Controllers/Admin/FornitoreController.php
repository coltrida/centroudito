<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\FornitoriService;
use Illuminate\Http\Request;

class FornitoreController extends Controller
{
    public function fornitori(FornitoriService $fornitoriService)
    {
        $fornitori = $fornitoriService->fornitori();
        return view('admin.fornitori.index', compact('fornitori'));
    }

    public function aggiungiFornitore()
    {
        return view('admin.fornitori.aggiungi');
    }

    public function salvaFornitore(Request $request, FornitoriService $fornitoriService)
    {
        $fornitoriService->addFornitore($request);
        return \Redirect::route('admin.fornitori');
    }

    public function eliminaFornitore($id, FornitoriService $fornitoriService)
    {
        $fornitoriService->eliminaFornitore($id);
        return \Redirect::route('admin.fornitori');
    }
}
