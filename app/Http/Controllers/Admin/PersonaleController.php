<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\RuoloService;
use App\Services\UserService;
use Illuminate\Http\Request;

class PersonaleController extends Controller
{
    public function personale(UserService $userService)
    {
        $users = $userService->lista();
        return view('admin.personale.index', compact('users'));
    }

    public function aggiungiPersonale(RuoloService $ruoloService)
    {
        $ruoli = $ruoloService->lista();
        return view('admin.personale.aggiungi', compact('ruoli'));
    }

    public function salvaPersonale(Request $request, UserService $userService)
    {
        $userService->aggiungi($request);
        return \Redirect::route('admin.personale');
    }

    public function eliminaPersonale($id, UserService $userService)
    {
        $userService->elimina($id);
        return \Redirect::route('admin.personale');
    }
}
