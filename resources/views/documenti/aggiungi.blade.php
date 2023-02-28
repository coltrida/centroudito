@extends('layouts.style')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Aggiungi Paziente</h1>
        </div>
        <div>
            <a class="btn btn-warning" href="{{route('documenti', $idClient)}}">Annulla</a>
        </div>
    </div>

    <form action="{{route('salvaDocumento')}}" method="post" enctype="multipart/form-data">
    @csrf
        <input type="hidden" name="idClient" value="{{$idClient}}">
        <div class="row">
            <div class="col">
                <input class="form-control" type="file" id="file" name="file" accept=".pdf">
                <label for="file" class="ml-2 text-gray-600">Seleziona File</label>
            </div>
            <div class="col">
                <select class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                    <option selected></option>
                    <option>Carta di Identità</option>
                    <option>Pratica Asl</option>
                    <option>Invalidità</option>
                </select>
                <label for="tipo" class="ml-2 text-gray-600">Tipologia</label>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Inserisci</button>
            </div>
        </div>

    </form>

@endsection
