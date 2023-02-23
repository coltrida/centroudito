@extends('layouts.style')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Aggiungi Paziente</h1>
        </div>
        <div>
            <a class="btn btn-warning" href="{{route('clients', $idFiliale)}}">Annulla</a>
        </div>
    </div>

    <form action="{{isset($client->id) ? route('client.modifica') : route('client.salva')}}" method="post">
    @csrf
    @if(isset($client->id))
        @method('PATCH')
        <input type="hidden" name="id" value="{{$client->id}}">
    @endif
    <div class="row">
        <div class="col-3">
            <input type="text" class="form-control border-dark shadow" id="nome" name="nome" value="{{$client->nome}}">
            <label for="nome" class="text-gray-600">Nome</label>
        </div>

        <div class="col-3">
            <input type="text" class="form-control border-dark shadow" id="cognome" name="cognome" value="{{$client->cognome}}">
            <label for="cognome" class="text-gray-600">Cognome</label>
        </div>

        <div class="col-4">
            <input type="text" class="form-control border-dark shadow" id="indirizzo" name="indirizzo" value="{{$client->indirizzo}}">
            <label for="indirizzo" class="ml-2 text-gray-600">Indirizzo</label>
        </div>

        <div class="col-2">
            <input type="text" class="form-control border-dark shadow" id="citta" name="citta" value="{{$client->citta}}">
            <label for="citta" class="ml-2 text-gray-600">Città</label>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-2">
            <input type="number" class="form-control border-dark shadow" id="telefono" name="telefono" value="{{$client->telefono}}">
            <label for="telefono" class="ml-2 text-gray-600">Telefono</label>
        </div>

        <div class="col-2">
            <input type="number" class="form-control border-dark shadow" id="telefono2" name="telefono2" value="{{$client->telefono2}}">
            <label for="telefono2" class="ml-2 text-gray-600">Telefono 2</label>
        </div>

        <div class="col-2">
            <input type="number" class="form-control border-dark shadow" id="telefono3" name="telefono3" value="{{$client->telefono3}}">
            <label for="telefono3" class="ml-2 text-gray-600">Telefono 3</label>
        </div>

        <div class="col-1">
            <input type="number" class="form-control border-dark shadow" id="cap" name="cap" value="{{$client->cap}}">
            <label for="cap" class="ml-2 text-gray-600">CAP</label>
        </div>

        <div class="col-1">
            <input type="text" class="form-control border-dark shadow" id="provincia" name="provincia" value="{{$client->provincia}}">
            <label for="provincia" class="ml-2 text-gray-600">Provincia</label>
        </div>

        <div class="col-3">
            <input type="text" class="form-control border-dark shadow" id="email" name="email" value="{{$client->email}}">
            <label for="email" class="ml-2 text-gray-600">email</label>
        </div>

        <div class="col-1">
            <select class="form-select border-dark shadow" aria-label="Default select example" id="tipologia_id" name="tipologia_id">
                <option selected></option>
                @foreach($tipologia as $item)
                    <option value="{{$item->id}}" {{$item->id == $client->tipologia_id ? 'selected' : ''}}>{{$item->nome}}</option>
                @endforeach
            </select>
            <label for="tipologia_id" class="ml-2 text-gray-600">Tipo</label>
        </div>
    </div>

        <div class="row mt-5">
            <div class="col-2">
                <input type="date" class="form-control border-dark shadow" id="datanascita" name="datanascita" value="{{$client->datanascita}}">
                <label for="datanascita" class="ml-2 text-gray-600">Data di Nascita</label>
            </div>

            <div class="col-2">
                <select class="form-select border-dark shadow" aria-label="Default select example" id="marketing_id" name="marketing_id">
                    <option selected></option>
                    @foreach($canali as $item)
                        <option value="{{$item->id}}" {{$item->id == $client->marketing_id ? 'selected' : ''}}>{{$item->name}}</option>
                    @endforeach
                </select>
                <label for="marketing_id" class="ml-2 text-gray-600">Fonte</label>
            </div>

            <div class="col-3">
                <select class="form-select border-dark shadow" aria-label="Default select example" id="user_id" name="user_id">
                    <option selected></option>
                    @foreach($audio as $item)
                        <option value="{{$item->id}}" {{$item->id === Auth::id() ? 'selected' : ''}}>{{$item->name}}</option>
                    @endforeach
                </select>
                <label for="user_id" class="ml-2 text-gray-600">Audio</label>
            </div>

            <div class="col-2">
                <select class="form-select border-dark shadow" aria-label="Default select example" id="filiale_id" name="filiale_id">
                    <option selected></option>
                    @foreach($filiali as $item)
                        <option value="{{$item->id}}" {{$item->id == $idFiliale ? 'selected' : ''}}>{{$item->nome}}</option>
                    @endforeach
                </select>
                <label for="filiale_id" class="ml-2 text-gray-600">Filiale</label>
            </div>

            <div class="col-3">
                <select class="form-select border-dark shadow" aria-label="Default select example" id="recapito_id" name="recapito_id">
                    <option selected></option>
                    @foreach($recapiti as $item)
                        <option value="{{$item->id}}" {{$item->id == $client->recapito_id ? 'selected' : ''}}>{{$item->nome}}</option>
                    @endforeach
                </select>
                <label for="recapito_id" class="ml-2 text-gray-600">Recapito</label>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-4">
                <select class="form-select border-dark shadow" aria-label="Default select example" id="medico_id" name="medico_id">
                    <option selected></option>
                    @foreach($medici as $item)
                        <option value="{{$item->id}}" {{$item->id == $client->medico_id ? 'selected' : ''}}>{{$item->nome}}</option>
                    @endforeach
                </select>
                <label for="medico_id" class="ml-2 text-gray-600">Medico</label>
            </div>

            <div class="col-4">
                <input type="text" class="form-control border-dark shadow" id="luogoNascita" name="luogoNascita" value="{{$client->luogoNascita}}">
                <label for="luogoNascita" class="ml-2 text-gray-600">Luogo di Nascita</label>
            </div>

            <div class="col-4">
                <input type="text" class="form-control border-dark shadow" id="codfisc" name="codfisc" value="{{$client->codfisc}}">
                <label for="codfisc" class="ml-2 text-gray-600">Codice Fiscale</label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-5">{{isset($client->id) ? 'Modifica' : 'Inserisci'}}</button>

    </form>

@endsection
