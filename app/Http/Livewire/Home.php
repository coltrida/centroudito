<?php

namespace App\Http\Livewire;

use App\Models\Filiale;
use App\Services\ClientService;
use App\Services\DdtService;
use App\Services\FilialeService;
use App\Services\ProductService;
use App\Services\ProvaService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function array_push;
use function array_splice;
use function dd;
use function session;
use function view;

class Home extends Component
{
    public $ddt = [];
    public $matricola = [];
    public $filialeSelezionata = '';

    protected $listeners = [
        'clientFattura',
    ];

    public function aggiungiAlDdt($product, $idFiliale, DdtService $ddtService)
    {
        $product['matricolaAssociata'] = $this->matricola[$product['id']];
        array_push($this->ddt, $product);
        $ddtService->inserimentoTemporaneoProdotto($product['id']);
        $this->filialeSelezionata = $idFiliale;
       // dd($this->aperto[$idFiliale]);
    }

    public function removeFromDdt($id, DdtService $ddtService)
    {
        array_splice($this->ddt, $id, 1);
        $ddtService->eliminazioneTemporaneaProdotto($id);
    }

    public function produciDdt(DdtService $ddtService)
    {
        if(!$ddtService->produciDdt($this->ddt)){
            session()->flash('message', 'Errore di produzione DDT');
        } else {
            session()->flash('message', 'DDT prodotto');
        }
        $this->ddt = [];
    }

    public function clientFattura($id, ProvaService $provaService)
    {
        $provaService->fattura($id);
    }

    public function reso($id, ProvaService $provaService)
    {
        $provaService->rimuovi($id);
    }

    public function render(UserService $userService, ProductService $productService, ClientService $clientService, FilialeService $filialeService)
    {
        $parametri = [];
        $nomeVista = 'livewire.home.home-admin';
        $parametri = [
            'audioprotesisti' => [],
            'filiali' => [],
            'amministrativi' => [],
            'proveInCorso' => [],
            'finalizzati' => [],
            'FilialiprodottiRichiesti' => [],
            'recallsOggi' => [],
            'recallsDomani' => []
        ];
        if (isset($userService->getUser()->name)){
            if ($userService->isAdmin()){
                $nomeVista = 'livewire.home.home-admin';
                $parametri = [
                    'audioprotesisti' => $userService->getAudioprotesisti(),
                    'filiali' => $userService->getFiliali(),
                    'amministrativi' => $userService->getAmministrazione(),
                ];
            } elseif ($userService->isAudio()){
                $nomeVista = 'livewire.home.home-audio';
                $parametri = [
                    'budget' => $userService->getBudgetDelMese(Auth::id()),
                    'proveInCorso' => $userService->proveInCorso(),
                    'finalizzati' => $userService->finalizzatiDelMese(),
                    'appuntamentiOggi' => $userService->appuntamentiOggi(),
                    'appuntamentiDomani' => $userService->appuntamentiDomani(),
                ];
            } elseif ($userService->isAmministrazione()){
                $nomeVista = 'livewire.home.home-amministrazione';
                $parametri = [
                    'FilialiprodottiRichiesti' => $productService->prodottiRichiestiTutteFiliali(),
                    'recallsOggi' => $clientService->getRecallsOggi(),
                    'recallsDomani' => $clientService->getRecallsDomani(),
                    'aperto' => $filialeService->caricaId($this->filialeSelezionata)
                ];
            }
        }

        return view($nomeVista, $parametri);
    }
}
