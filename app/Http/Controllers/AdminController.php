<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\CategoriaService;
use App\Services\FilialeService;
use App\Services\FornitoriService;
use App\Services\ListinoService;
use App\Services\MarketingService;
use App\Services\RecapitoService;
use App\Services\RuoloService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    // ------------------------------ FILIALI ------------------------------------//

    public function filiali(FilialeService $filialeService)
    {
        $filiali = $filialeService->lista();
        return view('admin.filiali.index', compact('filiali'));
    }

    public function aggiungiFiliale()
    {
        return view('admin.filiali.aggiungi');
    }

    public function salvaFiliale(Request $request, FilialeService $filialeService)
    {
        $filialeService->aggiungi($request);
        return \Redirect::route('admin.filiali');
    }

    public function eliminaFiliale($id, FilialeService $filialeService)
    {
        $filialeService->elimina($id);
        return \Redirect::route('admin.filiali');
    }

    public function listaFilialiAudio($id, FilialeService $filialeService)
    {
        return $filialeService->filialiAudio($id);
    }

    // ------------------------------ RECAPITI ------------------------------------//

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

    // ------------------------------ PERSONALE ------------------------------------//

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

    // ------------------------------ FORNITORI ------------------------------------//

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

    // ------------------------------ CATEGORIE ------------------------------------//

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

    // ------------------------------ LISTINO ------------------------------------//

    public function listino(ListinoService $listinoService)
    {
        $listino = $listinoService->listino();
        return view('admin.listino.index', compact('listino'));
    }

    public function aggiungiListino(FornitoriService $fornitoriService, CategoriaService $categoriaService, FilialeService $filialeService)
    {
        $fornitori = $fornitoriService->fornitori();
        $categorie = $categoriaService->lista();
        $filiali = $filialeService->lista();
        return view('admin.listino.aggiungi', compact('fornitori', 'categorie', 'filiali'));
    }

    public function salvaListino(Request $request, ListinoService $listinoService)
    {
        $listinoService->inserisci($request);
        return \Redirect::route('admin.listino');
    }

    public function eliminaListino($id, ListinoService $listinoService)
    {
        $listinoService->rimuovi($id);
        return \Redirect::route('admin.listino');
    }

    // ------------------------------ MARKETING ------------------------------------//

    public function marketing(MarketingService $marketingService)
    {
        $canali = $marketingService->canali();
        return view('admin.marketing.index', compact('canali'));
    }

    public function salvaMarketing(Request $request, MarketingService $marketingService)
    {
        $marketingService->addCanale($request);
        return \Redirect::route('admin.marketing');
    }

    public function eliminaMarketing($id, MarketingService $marketingService)
    {
        $marketingService->eliminaCanale($id);

        return back()->with('message','Canale Eliminato');
    }

    // ------------------------------ BUDGET ------------------------------------//

    public function budget(UserService $userService)
    {
        return view('admin.budget.index');
    }

    public function sceltaAnno(Request $request, UserService $userService)
    {
        $audioSenzaBgt = $userService->audioSenzaBgt($request);
        $audioConBgt = $userService->audioConBgt($request);
        $anno = $request->anno;
        return view('admin.budget.index', compact('audioSenzaBgt', 'audioConBgt', 'anno'));
    }

    public function salvaBudget(Request $request, UserService $userService)
    {
        $userService->assegnaBgt($request);
        $audioSenzaBgt = $userService->audioSenzaBgt($request);
        $audioConBgt = $userService->audioConBgt($request);
        $anno = $request->anno;
        return view('admin.budget.index', compact('audioSenzaBgt', 'audioConBgt', 'anno'));
    }

    public function eliminaBudget($id, UserService $userService)
    {
        $userService->eliminaBgt($id);

        return \Redirect::route('admin.budget')->with('message','Budget Eliminato');
    }
}
