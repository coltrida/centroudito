<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Services\AppuntamentiService;
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
    public function index()
    {
        return view('home');
    }

    //------------------------------- CLIENTI -------------------------------------//

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

    //------------------------------- APPUNTAMENTI -------------------------------------//

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
