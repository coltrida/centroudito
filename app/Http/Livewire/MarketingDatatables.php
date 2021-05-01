<?php

namespace App\Http\Livewire;

use App\Models\Marketing;
use App\Services\MarketingService;
use Livewire\Component;
use function session;
use function view;

class MarketingDatatables extends Component
{

    public $newCanale;

    public function addCanale(MarketingService $marketingService)
    {
        if(!$marketingService->inserisci($this->newCanale)){
            session()->flash('message', 'Errore di inserimento');
        } else {
            session()->flash('message', 'Canale Marketing inserito');
        }
        $this->newCanale = '';
    }

    public function remove($canaleId, MarketingService $marketingService)
    {
        if(!$marketingService->rimuovi($canaleId)){
            session()->flash('message', 'Errore di cancellazione');
        } else {
            session()->flash('message', 'Canale Marketing eliminato');
        }
    }

    public function render(MarketingService $marketingService)
    {
        return view('livewire.marketing.marketing-datatables', [
            'canali' => $marketingService->canali()
        ]);
    }
}
