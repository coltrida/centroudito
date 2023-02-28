@extends('layouts.style')

@section('content')

    <div class="row">
        <div class="col-7">
            @livewire('prova', ['idClient' => $idClient])
        </div>
        <div class="col-5">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <div>
                    <h3>Storico Prove</h3>
                </div>
                <div>
                    <a href="{{URL::previous()}}" class="btn btn-warning">
                        Annulla
                    </a>
                </div>
            </div>
            @livewire('storico-prove', ['idClient' => $idClient])
        </div>
    </div>


@endsection

