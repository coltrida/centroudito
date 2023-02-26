<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CategoriaService;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function categorie(CategoriaService $categoriaService)
    {
        $categorie = $categoriaService->lista();
        return view('admin.categorie.index', compact('categorie'));
    }

    public function salvaCategoria(Request $request, CategoriaService $categoriaService)
    {
        $categoriaService->aggiungi($request);
        return \Redirect::route('admin.categorie');
    }

    public function eliminaCategoria($id, CategoriaService $categoriaService)
    {
        $categoriaService->elimina($id);
        return \Redirect::route('admin.categorie');
    }
}
