@extends('layouts.style')

@section('content')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="confermaElimina" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma Eliminazione <span
                            id="nomeClienteElimina"></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sei sicuro di voler eliminare l'appuntamento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <form action="{{route('client.elimina')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-primary">Conferma</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                Prava per {{$cliente->nome.' '.$cliente->cognome}}
            </h1>
        </div>
        <div>
            <a class="btn btn-success" href="{{ route('clients', $cliente->filiale_id) }}">Annulla</a>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <form action="{{route('prova.aggiungi')}}" method="post">
                @csrf
                <input type="hidden" name="client_id" value="{{$cliente->id}}">
                <input type="hidden" name="user_id" value="{{$cliente->user->id}}">
                <div class="row mt-5">
                    <div class="col-4">
                        <select class="form-select border-dark shadow" aria-label="Default select example"
                                id="marketing_id" name="marketing_id">
                            <option selected></option>
                            @foreach($canali as $item)
                                <option
                                    value="{{$item->id}}" {{$item->id == $cliente->marketing_id ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                        <label for="marketing_id" class="ml-2 text-gray-600">Canale Mkt</label>
                    </div>

                    <div class="col-4">
                        <select class="form-select border-dark shadow" aria-label="Default select example"
                                id="mercato" name="mercato">
                            <option selected></option>
                                <option>libero</option>
                                <option>riconducibile</option>
                                <option>sociale</option>
                        </select>
                        <label for="mercato" class="ml-2 text-gray-600">Mercato</label>
                    </div>

                </div>

                <div class="row mt-5">
                    <div class="col-4">
                        <select class="form-select border-dark shadow" aria-label="Default select example"
                                id="filiale_id" name="filiale_id">
                            <option selected></option>
                        </select>
                        <label for="filiale_id" class="ml-2 text-gray-600">Filiale</label>
                    </div>

                    <div class="col-4">
                        <select class="form-select border-dark shadow" aria-label="Default select example"
                                id="recapito_id" name="recapito_id">
                            <option selected></option>
                        </select>
                        <label for="recapito_id" class="ml-2 text-gray-600">Recapito</label>
                    </div>

                    <div class="col-4">
                        <select class="form-select border-dark shadow" aria-label="Default select example"
                                id="tipo" name="tipo">
                            <option selected></option>
                            <option>Prima Visita</option>
                            <option>Assistenza</option>
                            <option>Consegna</option>
                            <option>Controllo Prova</option>
                            <option>Esame Audio</option>
                            <option>Fine Prova</option>
                            <option>Informazioni</option>
                            <option>Pulizia</option>
                        </select>
                        <label for="tipo" class="ml-2 text-gray-600">Tipo di Visita</label>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-8">
                        <textarea class="form-control border-dark shadow" id="note" rows="3"></textarea>
                        <label for="note" class="form-label">Note</label>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary">Inserisci</button>
                    </div>
                </div>
            </form>

        </div>

        <div class="col-6">
            <h3>Storico Prove</h3>
            <table class="table table-striped">
                <thead class="table-primary">
                <th scope="col">Giorno</th>
                <th scope="col">Orario</th>
                <th scope="col">Nota</th>
                <th scope="col">Luogo</th>
                <th scope="col">Tipo</th>
                <th scope="col">Action</th>
                </thead>
                <tbody >

                </tbody>
            </table>
        </div>
    </div>

@endsection

@extends('partial.gestioneModal')
