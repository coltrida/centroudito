<?php

namespace App\Http\Controllers;

use App\Services\ClientService;
use App\Services\DocumentoService;
use Illuminate\Http\Request;

class DocumentiController extends Controller
{
    public function documenti($idClient, DocumentoService $documentoService, ClientService $clientService)
    {
        $documenti = $documentoService->caricaDocumenti($idClient);
        $client = $clientService->cliente($idClient);
        return view('documenti.index', compact('documenti', 'client'));
    }

    public function aggiungiDocumento($idClient)
    {
        return view('documenti.aggiungi', compact('idClient'));
    }

    public function salvaDocumento(Request $request, DocumentoService $documentoService)
    {
        $documentoService->salvaDocumento($request);
        return \Redirect::route('documenti', $request->idClient);
    }
}
