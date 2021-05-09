@extends('stile')

@section('main')
    <div style="height: 20rem; width: 30rem; color: black; background-color: white!important;" xmlns:livewire="">
        <livewire:livewire-line-chart
            :line-chart-model="$lineChartModel"
        />
    </div>
@endsection
