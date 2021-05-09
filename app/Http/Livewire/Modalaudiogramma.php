<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Livewire\Component;
use function compact;
use function dd;

class Modalaudiogramma extends Component
{
    public $visibile = true;
    public $visualizza = 1;
    public $audiometrie = [];
    public $destro = [];
    public $sinistro = [];

    protected $listeners = [
        'clientSelectedAudiogramma',
    ];

    public function clientSelectedAudiogramma($id)
    {
        $this->visibile = false;
        $this->audiometrie = Client::with('audiometria')->find($id)->audiometria;
    }

    public function closeModal()
    {
        $this->visibile = true;
    }

    public function cambia($value)
    {
        $this->visualizza = $value;
        if ($value == 1){
            dd($this->sinistro);
        }
    }

    public function render()
    {
        $lineChartModel =
            (new LineChartModel())
                ->setTitle('Audiometria')
                ->setDataLabelsEnabled(true)
                ->setAnimated(true)
                ->setLegendVisibility(true)
                ->multiLine()->setColors(['#0011ff', '#FF0000'])

                ->addSeriesPoint('Sinistro', 125, -20)
                ->addSeriesPoint('Sinistro', 250, -20)
                ->addSeriesPoint('Sinistro', 500, -30)
                ->addSeriesPoint('Sinistro', 1000, -40)
                ->addSeriesPoint('Sinistro', 2000, -50)
                ->addSeriesPoint('Sinistro', 4000, -50)
                ->addSeriesPoint('Sinistro', 6000, -60)
                ->addSeriesPoint('Sinistro', 8000, -70)

                ->addSeriesPoint('Destro', 125, -20)
                ->addSeriesPoint('Destro', 250, -25)
                ->addSeriesPoint('Destro', 500, -30)
                ->addSeriesPoint('Destro', 1000, -45)
                ->addSeriesPoint('Destro', 2000, -55)
                ->addSeriesPoint('Destro', 4000, -65)
                ->addSeriesPoint('Destro', 6000, -70)
                ->addSeriesPoint('Destro', 8000, -70)
        ;
        return view('livewire.modalClient.modalaudiogramma', compact('lineChartModel'));
    }
}
