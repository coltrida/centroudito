@extends('stile')

@section('main')
    <div style="height: 32rem;" xmlns:livewire="">
        <livewire:livewire-column-chart
            :column-chart-model="$columnChartModel"
        />
    </div>
@endsection
