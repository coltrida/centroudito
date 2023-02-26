<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RecapitoService;
use App\Services\UserService;
use Illuminate\Http\Request;

class RecapitoController extends Controller
{
    public function recapiti(RecapitoService $recapitoService)
    {
        $recapiti = $recapitoService->lista();
        return view('admin.recapiti.index', compact('recapiti'));
    }

    public function aggiungiRecapito(UserService $userService)
    {
        $audios = $userService->audio();
        return view('admin.recapiti.aggiungi', compact('audios'));
    }

    public function salvaRecapito(Request $request, RecapitoService $recapitoService)
    {
        $recapitoService->aggiungi($request);
        return \Redirect::route('admin.recapiti');
    }

    public function eliminaRecapito($id, RecapitoService $recapitoService)
    {
        $recapitoService->elimina($id);
        return \Redirect::route('admin.recapiti');
    }
}
