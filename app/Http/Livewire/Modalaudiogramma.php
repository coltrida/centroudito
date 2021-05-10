<?php

namespace App\Http\Livewire;

use App\Services\AudiogrammaService;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Livewire\Component;
use function compact;
use function count;
use function dd;

class Modalaudiogramma extends Component
{
    public $visibile = true;
    public $visualizza = 1;
    public $idClient;
    public $audiometrie = [];
    public $destro = [];
    public $sinistro = [];
    public $attualeSinistro = [];
    public $attualeDestro = [];
    public $sin125;
    public $sin250;
    public $sin500;
    public $sin1000;
    public $sin1500;
    public $sin2000;
    public $sin3000;
    public $sin4000;
    public $sin6000;
    public $sin8000;

    protected $listeners = [
        'clientSelectedAudiogramma',
    ];

    public function clientSelectedAudiogramma($id)
    {
        $this->visibile = false;
        $this->idClient = $id;
    }

    public function closeModal()
    {
        $this->visibile = true;
        $this->visualizza = 1;
    }

    public function cambia($value, AudiogrammaService $audiogrammaService)
    {
        $this->visualizza = $value;
        if ($value == 1){
            $audiogrammaService->salva($this->idClient, $this->destro, $this->sinistro);
            $this->sinistro = [];
            $this->destro = [];
        }
    }

    public function mount()
    {
        $this->attualeSinistro = [0,0,0,0,0,0,0,0,0,0];
        $this->attualeDestro = [0,0,0,0,0,0,0,0,0,0];
    }

    public function render(AudiogrammaService $audiogrammaService)
    {
        $this->audiometrie = $this->idClient ? $audiogrammaService->caricaAudiometrie($this->idClient) : [];

        $this->attualeSinistro[0] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_125s : 0;
        $this->attualeSinistro[1] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_250s : 0;
        $this->attualeSinistro[2] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_500s : 0;
        $this->attualeSinistro[3] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_1000s : 0;
        $this->attualeSinistro[4] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_1500s : 0;
        $this->attualeSinistro[5] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_2000s : 0;
        $this->attualeSinistro[6] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_3000s : 0;
        $this->attualeSinistro[7] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_4000s : 0;
        $this->attualeSinistro[8] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_6000s : 0;
        $this->attualeSinistro[9] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_8000s : 0;

        $this->attualeDestro[0] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_125d : 0;
        $this->attualeDestro[1] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_250d : 0;
        $this->attualeDestro[2] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_500d : 0;
        $this->attualeDestro[3] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_1000d : 0;
        $this->attualeDestro[4] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_1500d : 0;
        $this->attualeDestro[5] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_2000d : 0;
        $this->attualeDestro[6] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_3000d : 0;
        $this->attualeDestro[7] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_4000d : 0;
        $this->attualeDestro[8] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_6000d : 0;
        $this->attualeDestro[9] =count($this->audiometrie) > 0 ? $this->audiometrie[0]->_8000d : 0;

            $lineChartModel =
                (new LineChartModel())
                    ->setTitle('Audiometria')
                    ->setDataLabelsEnabled(true)
                    ->setAnimated(true)
                    ->setLegendVisibility(true)
                    ->multiLine()->setColors(['#0011ff', '#FF0000'])
                    ->addSeriesPoint('Sinistro', 125,
                        $this->attualeSinistro[0] ? (int)$this->attualeSinistro[0] : (int)$this->attualeSinistro[1])
                    ->addSeriesPoint('Sinistro', 250,
                        $this->attualeSinistro[1] ? (int)$this->attualeSinistro[1] : ((int)$this->attualeSinistro[0] + (int)$this->attualeSinistro[2])/2 )
                    ->addSeriesPoint('Sinistro', 500,
                        $this->attualeSinistro[2] ? (int)$this->attualeSinistro[2] : ((int)$this->attualeSinistro[1] + (int)$this->attualeSinistro[3])/2 )
                    ->addSeriesPoint('Sinistro', 1000,
                        $this->attualeSinistro[3] ? (int)$this->attualeSinistro[3] : ((int)$this->attualeSinistro[2] + (int)$this->attualeSinistro[4])/2 )
                    ->addSeriesPoint('Sinistro',1500,
                           $this->attualeSinistro[4] ? (int)$this->attualeSinistro[4] : ((int)$this->attualeSinistro[3] + (int)$this->attualeSinistro[5])/2 )
                    ->addSeriesPoint('Sinistro', 2000,
                        $this->attualeSinistro[5] ? (int)$this->attualeSinistro[5] : ((int)$this->attualeSinistro[4] + (int)$this->attualeSinistro[6])/2 )
                    ->addSeriesPoint('Sinistro', 3000,
                        $this->attualeSinistro[6] ? (int)$this->attualeSinistro[6] : ((int)$this->attualeSinistro[5] + (int)$this->attualeSinistro[7])/2 )
                    ->addSeriesPoint('Sinistro', 4000,
                        $this->attualeSinistro[7] ? (int)$this->attualeSinistro[7] : ((int)$this->attualeSinistro[6] + (int)$this->attualeSinistro[8])/2 )
                    ->addSeriesPoint('Sinistro', 6000,
                        $this->attualeSinistro[8] ? (int)$this->attualeSinistro[8] : ((int)$this->attualeSinistro[7] + (int)$this->attualeSinistro[9])/2 )
                    ->addSeriesPoint('Sinistro', 8000,
                        $this->attualeSinistro[9] ? (int)$this->attualeSinistro[9] : (int)$this->attualeSinistro[8])

                    ->addSeriesPoint('Destro', 125,
                        $this->attualeDestro[0] ? (int)$this->attualeDestro[0] : (int)$this->attualeDestro[1])
                    ->addSeriesPoint('Destro', 250,
                        $this->attualeDestro[1] ? (int)$this->attualeDestro[1] : ((int)$this->attualeDestro[0] + (int)$this->attualeDestro[2])/2 )
                    ->addSeriesPoint('Destro', 500,
                        $this->attualeDestro[2] ? (int)$this->attualeDestro[2] : ((int)$this->attualeDestro[1] + (int)$this->attualeDestro[3])/2 )
                    ->addSeriesPoint('Destro', 1000,
                        $this->attualeDestro[3] ? (int)$this->attualeDestro[3] : ((int)$this->attualeDestro[2] + (int)$this->attualeDestro[4])/2 )
                    ->addSeriesPoint('Destro', 1500,
                        $this->attualeDestro[4] ? (int)$this->attualeDestro[4] : ((int)$this->attualeDestro[3] + (int)$this->attualeDestro[5])/2 )
                    ->addSeriesPoint('Destro', 2000,
                        $this->attualeDestro[5] ? (int)$this->attualeDestro[5] : ((int)$this->attualeDestro[4] + (int)$this->attualeDestro[6])/2 )
                    ->addSeriesPoint('Destro', 3000,
                        $this->attualeDestro[6] ? (int)$this->attualeDestro[6] : ((int)$this->attualeDestro[5] + (int)$this->attualeDestro[7])/2 )
                    ->addSeriesPoint('Destro', 4000,
                        $this->attualeDestro[7] ? (int)$this->attualeDestro[7] : ((int)$this->attualeDestro[6] + (int)$this->attualeDestro[8])/2 )
                    ->addSeriesPoint('Destro', 6000,
                        $this->attualeDestro[8] ? (int)$this->attualeDestro[8] : ((int)$this->attualeDestro[7] + (int)$this->attualeDestro[9])/2 )
                    ->addSeriesPoint('Destro', 8000,
                        $this->attualeDestro[9] ? (int)$this->attualeDestro[9] : (int)$this->attualeDestro[8])
            ;

//dd($lineChartModel);
        return view('livewire.modalClient.modalaudiogramma', compact('lineChartModel'));
    }
}
