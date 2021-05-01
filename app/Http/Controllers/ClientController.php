<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertClientRequest;
use App\Services\ClientService;
use App\Services\FilialeService;
use App\Services\MarketingService;
use App\Services\RecapitoService;
use App\Services\UserService;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function abort;
use function dd;
use function redirect;
use function view;

class ClientController extends Controller
{

    public function index(UserService $userService, $idAudio = '', $idFiliale = '')
    {
        if ($userService->userNonAutorizzato($idAudio) && $idAudio != ''){ abort(401); }
        return view('client.index', ['idAudio' => $idAudio, 'idFiliale' => $idFiliale ]);
    }

    public function inserisci(ClientService $clientService, MarketingService $marketingService, RecapitoService $recapitoService, FilialeService $filialeService, $id='')
    {
        return view('client.inserisci', [
            'client' => $clientService->getClient($id),
            'canali' => $marketingService->canali(),
            'filiali' => $filialeService->filiali(),
            'recapiti' => $recapitoService->recapiti()
        ]);
    }

    public function postInserisci(InsertClientRequest $request, ClientService $clientService)
    {
        if (!$clientService->inserisci($request)) {
            return redirect()->route('client.index')->withMessage("Errore nell'inserimento cliente");
        }
        return redirect()->route('client.index')->withMessage("Cliente Inserito");
    }

    public function modifica(InsertClientRequest $request, ClientService $clientService)
    {
        if (!$clientService->modifica($request)) {
            return redirect()->route('client.index')->withMessage("Errore nella modifica cliente");
        }
        return redirect()->route('client.index')->withMessage("Cliente {$request->nome} {$request->cognome} Modificato");
    }

    public function recall(Request $request, ClientService $clientService)
    {
        if (!$clientService->recall($request)) {
            return redirect()->back()->withMessage("Errore nell'inserimento recall");
        }
        return redirect()->back()->withMessage("recall Inserito");
    }
}
