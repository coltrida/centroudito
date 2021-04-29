@extends('stile')

@section('main')
    @if (session()->has('message'))
        <div class="col p-2 bg-green-200 text-green-800 rounded shadow-sm mb-1">
            {{ session('message') }}
        </div>
    @endif
    <div style="color: black">
        <livewire:client-datatables
            searchable="nome, cognome"
            :idAudio="$idAudio"
            :idFiliale="$idFiliale"
            exportable
        />

        <livewire:modalcall/>
        <livewire:modalnote/>
    </div>
@endsection
