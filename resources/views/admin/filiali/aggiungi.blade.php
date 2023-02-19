@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Aggiungi Filiale</h1>
        </div>
        <div>
            <a class="btn btn-warning" href="{{route('admin.filiali')}}">Annulla</a>
        </div>
    </div>

    <form action="" method="post">
    @csrf

    <div class="row">
        <div class="form-floating col-3">
            <input type="text" class="form-control" id="nome" name="nome" placeholder="name@example.com">
            <label for="nome" class="ml-2 text-gray-600">Nome</label>
        </div>

        <div class="form-floating col-5">
            <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="name@example.com">
            <label for="indirizzo" class="ml-2 text-gray-600">Indirizzo</label>
        </div>

        <div class="form-floating col-4">
            <input type="text" class="form-control" id="citta" name="citta" placeholder="name@example.com">
            <label for="citta" class="ml-2 text-gray-600">Città</label>
        </div>
    </div>

    <div class="row mt-5">
        <div class="form-floating col-3">
            <input type="number" class="form-control" id="telefono" name="telefono" placeholder="name@example.com">
            <label for="telefono" class="ml-2 text-gray-600">Telefono</label>
        </div>

        <div class="form-floating col-2">
            <input type="number" class="form-control" id="cap" name="cap" placeholder="name@example.com">
            <label for="cap" class="ml-2 text-gray-600">CAP</label>
        </div>

        <div class="form-floating col-2">
            <input type="text" class="form-control" id="provincia" name="provincia" placeholder="name@example.com">
            <label for="provincia" class="ml-2 text-gray-600">Provincia</label>
        </div>

        <div class="form-floating col-5">
            <input type="text" class="form-control" id="informazioni" name="informazioni" placeholder="name@example.com">
            <label for="informazioni" class="ml-2 text-gray-600">Info</label>
        </div>
    </div>
        <button type="submit" class="btn btn-primary mt-5">Inserisci</button>

    </form>

@endsection
