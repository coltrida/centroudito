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
                <input type="text" class="form-control" id="nome" name="nome" placeholder="name@example.com">
                <label for="nome" class="ml-2 text-gray-600">Nome</label>
            </div>

            <div class="form-floating col-4">
                <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="name@example.com">
                <label for="indirizzo" class="ml-2 text-gray-600">indirizzo</label>
            </div>

            <div class="form-floating col-3">
                <input type="text" class="form-control" id="citta" name="citta" placeholder="name@example.com">
                <label for="citta" class="ml-2 text-gray-600">citta</label>
            </div>

            <div class="form-floating col-2">
                <input type="text" class="form-control" id="cap" name="cap" placeholder="name@example.com">
                <label for="cap" class="ml-2 text-gray-600">cap</label>
            </div>
        </div>

        <div class="row mt-5">
            <div class="form-floating col-2">
                <input type="text" class="form-control" id="provincia" name="provincia" placeholder="name@example.com">
                <label for="provincia" class="ml-2 text-gray-600">provincia</label>
            </div>

            <div class="form-floating col-2">
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="name@example.com">
                <label for="telefono" class="ml-2 text-gray-600">telefono</label>
            </div>

            <div class="form-floating col-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                <label for="email" class="ml-2 text-gray-600">email</label>
            </div>

            <div class="form-floating col-3">
                <input type="email" class="form-control" id="pec" name="pec" placeholder="name@example.com">
                <label for="pec" class="ml-2 text-gray-600">pec</label>
            </div>

            <div class="form-floating col-2">
                <input type="text" class="form-control" id="univoco" name="univoco" placeholder="name@example.com">
                <label for="univoco" class="ml-2 text-gray-600">cod univ</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-5">Inserisci</button>

    </form>

@endsection
