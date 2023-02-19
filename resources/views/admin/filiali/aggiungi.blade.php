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
            <input type="text" class="form-control" id="nome" name="nome">
            <label for="nome">Nome</label>
        </div>

        <div class="form-floating col-5">
            <input type="text" class="form-control" id="indirizzo" name="indirizzo">
            <label for="indirizzo">Indirizzo</label>
        </div>

        <div class="form-floating col-4">
            <input type="text" class="form-control" id="citta" name="citta">
            <label for="citta">Città</label>
        </div>
    </div>

    <div class="row mt-5">
        <div class="form-floating col-3">
            <input type="number" class="form-control" id="telefono" name="telefono">
            <label for="telefono">Telefono</label>
        </div>

        <div class="form-floating col-2">
            <input type="number" class="form-control" id="cap" name="cap">
            <label for="cap">CAP</label>
        </div>

        <div class="form-floating col-2">
            <input type="text" class="form-control" id="provincia" name="provincia">
            <label for="provincia">Provincia</label>
        </div>

        <div class="form-floating col-5">
            <input type="text" class="form-control" id="informazioni" name="informazioni">
            <label for="informazioni">Info</label>
        </div>
    </div>
        <button type="submit" class="btn btn-primary">Inserisci</button>

    </form>

@endsection
