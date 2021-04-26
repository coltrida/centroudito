@extends('stile')

@section('main')
    <div style="color: black">
        <livewire:client-datatables
            searchable="name, telefono"
            :idAudio="$idAudio"
            exportable
        />
    </div>
@endsection
