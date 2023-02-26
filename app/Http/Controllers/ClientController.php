<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\ClientService;
use App\Services\DottoreService;
use App\Services\FilialeService;
use App\Services\MarketingService;
use App\Services\RecapitoService;
use App\Services\TipologiaService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function clientsFiliale($idFiliale, ClientService $clientService, FilialeService $filialeService)
    {
        $clients = $clientService->clienteFiliale($idFiliale);
        $filiale = $filialeService->filialeById($idFiliale);
        return view('client.index', compact('clients', 'filiale'));
    }

    public function aggiungiModificaClient($idFiliale,
                                           TipologiaService $tipologiaService,
                                           MarketingService $marketingService,
                                           ClientService $clientService,
                                           UserService $userService,
                                           RecapitoService $recapitoService, DottoreService $dottoreService,
        $idClient = null)
    {
        $client = $idClient ? $clientService->cliente($idClient) : new Client();
        $tipologia = $tipologiaService->lista();
        $canali = $marketingService->canali();
        $audio = $userService->audio();
        $recapiti = $recapitoService->lista();
        $medici = $dottoreService->lista(\Auth::user()->is_admin ? null : \Auth::id());
        return view('client.aggiungi', compact('idFiliale',
            'tipologia', 'canali', 'audio', 'recapiti', 'medici', 'client'));
    }

    public function salvaClient(Request $request , ClientService $clientService)
    {
        $clientService->aggiungi($request);
        return \Redirect::route('clients', $request->filiale_id)->with('message','Paziente Inserito');
    }

    public function ricercaClient(Request $request, ClientService $clientService, FilialeService $filialeService)
    {
        $clients = $clientService->filtraCliente($request);
        $filiale = $filialeService->filialeById($request->idFiliale);
        return view('client.index', compact('clients', 'filiale'));
    }

    public function modificaClient(Request $request, ClientService $clientService)
    {
        $clientService->aggiungi($request);
        return \Redirect::route('clients', $request->filiale_id)->with('message','Paziente Modificato');
    }

    public function eliminaClient(Request $request, ClientService $clientService)
    {
        $clientService->elimina($request);
        return \Redirect::route('clients', $request->filiale_id)->with('message','Paziente Eliminato');
    }
}
