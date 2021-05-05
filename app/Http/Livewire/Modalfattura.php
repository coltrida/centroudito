<?php

namespace App\Http\Livewire;


use Livewire\Component;

class Modalfattura extends Component
{
    public $visibile = true;

    protected $listeners = [
        'produciFattura'
    ];

    public function closeModal()
    {
        $this->clientId = '';
        $this->clientName = '';
        $this->visibile = true;
    }

    public function produciFattura($id)
    {
        $this->visibile = false;
    }

    public function render()
    {
        return view('livewire.modalClient.modalfattura');
    }
}
