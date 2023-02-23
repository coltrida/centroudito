<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Services\DottoreService;
use App\Services\FilialeService;
use App\Services\MarketingService;
use App\Services\RecapitoService;
use App\Services\TipologiaService;
use App\Services\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(FilialeService $filialeService)
    {
        return view('home');
    }

    public function clientsFiliale($idFiliale, ClientService $clientService)
    {
        $clients = $clientService->clienteFiliale($idFiliale);
        return view('client.index', compact('clients'));
    }

    public function aggiungiClient($idFiliale,
                                   TipologiaService $tipologiaService,
                                   MarketingService $marketingService,
                                   UserService $userService,
                                   RecapitoService $recapitoService, DottoreService $dottoreService)
    {
        $tipologia = $tipologiaService->lista();
        $canali = $marketingService->canali();
        $audio = $userService->audio();
        $recapiti = $recapitoService->lista();
        $medici = $dottoreService->lista(\Auth::user()->is_admin ? null : \Auth::id());
        return view('client.aggiungi', compact('idFiliale',
            'tipologia', 'canali', 'audio', 'recapiti', 'medici'));
    }

    public function salvaClient(Request $request , ClientService $clientService)
    {
        $clientService->aggiungi($request);
        return \Redirect::route('clients', $request->filiale_id);
    }

    public function eliminaClient($id)
    {

    }
}
