@extends('layouts.style')

@section('content')

    <div class="row">
        <div class="col-7">
            @livewire('prova', ['idClient' => $idClient])
        </div>
        <div class="col-5">
            <h3>Storico Prove</h3>
            @livewire('storico-prove', ['idClient' => $idClient])
        </div>
    </div>


@endsection

