@extends('stile')

@section('main')
    {{--<div style="color: black">
        <livewire:client-datatables
            searchable="name, telefono"
            :idAudio="$idAudio"
            exportable
        />
    </div>--}}

    <livewire:datatable
        model="App\Models\Client"
        sort="name|asc"
        include="id, name, indirizzo, citta, cap, provincia, telefono, tipo, created_at|Created"
        searchable="name"
        exportable
    />

@endsection
