@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Aggiungi Fornitore</h1>
        </div>
        <div>
            <a class="btn btn-warning" href="{{route('admin.fornitori')}}">Annulla</a>
        </div>
    </div>

    <form action="{{route('admin.fornitore.salva')}}" method="post">
    @csrf

        <div class="row">
            <div class="form-floating col-3">
                <input type="text" class="form-control" id="nome" name="nome">
                <label for="nome">Nome</label>
            </div>

            <div class="form-floating col-4">
                <input type="text" class="form-control" id="indirizzo" name="indirizzo">
                <label for="indirizzo">indirizzo</label>
            </div>

            <div class="form-floating col-3">
                <input type="text" class="form-control" id="citta" name="citta">
                <label for="citta">citta</label>
            </div>

            <div class="form-floating col-2">
                <input type="text" class="form-control" id="cap" name="cap">
                <label for="cap">cap</label>
            </div>
        </div>

        <div class="row">
            <div class="form-floating col-2">
                <input type="text" class="form-control" id="provincia" name="provincia">
                <label for="provincia">provincia</label>
            </div>

            <div class="form-floating col-2">
                <input type="text" class="form-control" id="telefono" name="telefono">
                <label for="telefono">telefono</label>
            </div>

            <div class="form-floating col-3">
                <input type="email" class="form-control" id="email" name="email">
                <label for="email">email</label>
            </div>

            <div class="form-floating col-3">
                <input type="email" class="form-control" id="pec" name="pec">
                <label for="pec">pec</label>
            </div>

            <div class="form-floating col-2">
                <input type="text" class="form-control" id="univoco" name="univoco">
                <label for="univoco">cod univ</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Inserisci</button>

    </form>

@endsection
