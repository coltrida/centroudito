<?php

namespace App\Http\Controllers;

use App\Services\AppuntamentiService;
use App\Services\ClientService;
use App\Services\RecapitoService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AppuntamentoController extends Controller
{
    public function appuntamentiClient($idClient,
                                       AppuntamentiService $appuntamentiService,
                                       ClientService $clientService,
                                       UserService $userService,
                                       RecapitoService $recapitoService)
    {
        $appuntamenti = $appuntamentiService->index($idClient);
        $cliente = $clientService->cliente($idClient);
        $audio = $userService->audio();
        $recapiti = $recapitoService->recapitiByAudio(\Auth::id());
        $appSettimana = [];
        $nomeGiorno = ['Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato'];
        $dateSettimana = $appuntamentiService->dateSettimana(null);
        $appSettimana[0] = $appuntamentiService->lunedi(\Auth::id(), null);
        $appSettimana[1] = $appuntamentiService->martedi(\Auth::id(), null);
        $appSettimana[2] = $appuntamentiService->mercoledi(\Auth::id(), null);
        $appSettimana[3] = $appuntamentiService->giovedi(\Auth::id(), null);
        $appSettimana[4] = $appuntamentiService->venerdi(\Auth::id(), null);
        $appSettimana[5] = $appuntamentiService->sabato(\Auth::id(), null);
        return view('appuntamenti.index', compact('appuntamenti', 'cliente',
            'audio', 'recapiti', 'appSettimana', 'dateSettimana', 'nomeGiorno'));
    }

    public function aggiungiAppuntamento(Request $request, AppuntamentiService $appuntamentiService)
    {
        $appuntamentiService->addAppuntamento($request);
        return \Redirect::back()->with('messaggio', 'Appuntamento inserito');
    }

    public function eliminaAppuntamento(Request $request, AppuntamentiService $appuntamentiService)
    {
        $appuntamentiService->eliminaAppuntamento($request->idAppuntamento);
        return \Redirect::route('clients', $request->filiale_id)->with('message','Appuntamento Eliminato');
    }
}
