@extends('stile')

@section('main')
    <div style="height: 32rem;" xmlns:livewire="">
        <div style="display: flex; justify-content: space-between; align-items: center; height: 32rem;">


        {{--<livewire:statistiche.livewire-chart
            :area-chart-model="$areaChartModel"
        />--}}

        <livewire:statistiche.livewire-chart
            :line-chart-model="$lineChartModel"
        />

        <livewire:statistiche.livewire-chart
            :column-chart-model="$columnChartModel"
        />

        </div>
    </div>
@endsection
