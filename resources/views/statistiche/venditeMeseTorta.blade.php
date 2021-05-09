@extends('stile')

@section('main')
    <div style="height: 32rem;" xmlns:livewire="">
        <livewire:livewire-pie-chart
            :pie-chart-model="$pieChartModel"
        />
    </div>
@endsection
