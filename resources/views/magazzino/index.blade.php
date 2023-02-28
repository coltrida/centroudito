@extends('layouts.style')

@section('content')

    <div class="row">
        <div class="col-12">
            @livewire('magazzino', ['idFiliale' => $idFiliale])
        </div>
    </div>
@endsection

