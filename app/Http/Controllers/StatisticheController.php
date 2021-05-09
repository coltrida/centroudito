<?php

namespace App\Http\Controllers;

use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function compact;
use function view;

class StatisticheController extends Controller
{
    public function venditeMeseIstogramma()
    {
        $columnChartModel =
            (new ColumnChartModel())
                ->setTitle('Expenses by Type')
                ->addColumn('Food', 100, '#f6ad55')
                ->addColumn('Shopping', 200, '#fc8181')
                ->addColumn('Travel', 300, '#90cdf4')
        ;
        return view('statistiche.venditeMeseIstogramma', compact('columnChartModel'));
    }

    public function venditeMeseLinea()
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
        return view('statistiche.venditeMeseLinea', compact('lineChartModel'));
    }

    public function venditeMeseTorta()
    {
        $pieChartModel =
            (new PieChartModel())
                ->setTitle('Expenses by Type')
                ->addSlice('Food', 100, '#000000')
                ->addSlice('Travel', 200, '#9153C2')
                ->addSlice('Shopping', 300, '#f6ad55')
        ;
        return view('statistiche.venditeMeseTorta', compact('pieChartModel'));
    }
}
