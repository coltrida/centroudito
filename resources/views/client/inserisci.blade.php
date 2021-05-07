@extends('stile')

@section('main')
    @if(session()->has('message'))
        <div class="alert-warning">
            {{session()->get('message')}}
        </div>
    @endif

    @if(isset($client->nome))
        <form action="{{route('client.modifica')}}" method="post">
        @method('PATCH')
        <input type="hidden" name="id" value="{{$client->id}}">
        @csrf
    @else
        <form action="{{route('client.postInserisci')}}" method="post">
        @csrf
    @endif

        <div class="row">
            <div class="mb-3 col-3">
                <label for="nome" class="form-label">Nome @error('nome') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" @if(isset($client->nome)) value="{{$client->nome}}" @endif class="form-control" id="nome" name="nome" placeholder="nome">
            </div>
            <div class="mb-3 col-3">
                <label for="cognome" class="form-label">Cognome @error('cognome')  <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" @if(isset($client->nome)) value="{{$client->cognome}}" @endif class="form-control" id="cognome" name="cognome" placeholder="cognome">
            </div>
            <div class="mb-3 col-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="text" @if(isset($client->nome)) value="{{$client->telefono}}" @endif class="form-control" id="telefono" name="telefono" placeholder="telefono">
            </div>
            <div class="mb-3 col-3">
                <label for="codfisc" class="form-label">Codice Fiscale</label>
                <input type="text" @if(isset($client->nome)) value="{{$client->codfisc}}" @endif class="form-control" id="codfisc" name="codfisc" placeholder="codice fiscale">
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-3">
                <label for="indirizzo" class="form-label">Indirizzo @error('indirizzo') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" @if(isset($client->nome)) value="{{$client->indirizzo}}" @endif class="form-control" id="indirizzo" name="indirizzo" placeholder="indirizzo">
            </div>
            <div class="mb-3 col-3">
                <label for="citta" class="form-label">Città @error('citta') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" @if(isset($client->nome)) value="{{$client->citta}}" @endif class="form-control" id="citta" name="citta" placeholder="citta">
            </div>
            <div class="mb-3 col-2">
                <label for="cap" class="form-label">CAP @error('cap') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" @if(isset($client->nome)) value="{{$client->cap}}" @endif class="form-control" id="cap" name="cap" placeholder="CAP">
            </div>
            <div class="mb-3 col-2">
                <label for="provincia" class="form-label">Provincia @error('provincia') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" @if(isset($client->nome)) value="{{$client->provincia}}" @endif class="form-control" id="provincia" name="provincia" placeholder="PR">
            </div>
            <div class="mb-3 col-2">
                <label for="filiale_id" class="form-label">Filile @error('filiale_id') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" aria-label="Default select example" name="filiale_id" id="filiale_id">
                    <option selected></option>
                    @foreach($filiali as $filiale)
                        <option @if(isset($client->nome)) {{$filiale->id == $client->filiale_id ? 'selected' : ''}} @else {{$filiale->id == $idFiliale ? 'selected' : ''}} @endif  value="{{$filiale->id}}">{{$filiale->nome}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-3">
                <label for="recapito_id" class="form-label">Recapito @error('recapito_id') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" aria-label="Default select example" name="recapito_id" id="recapito_id">
                    <option selected></option>
                    @foreach($recapiti as $recapito)
                        <option @if(isset($client->nome)) {{$recapito->id == $client->recapito_id ? 'selected' : ''}} @endif value="{{$recapito->id}}">{{$recapito->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-3">
                <label for="mail" class="form-label">email</label>
                <input type="text" @if(isset($client->nome)) value="{{$client->mail}}" @endif class="form-control" id="mail" name="mail" placeholder="e-mail">
            </div>
            <div class="mb-3 col-2">
                <label for="tipo" class="form-label">Tipo @error('tipo') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                    <option selected></option>
                    @foreach($tipi as $tipo)
                        <option @if(isset($client->nome)) {{$tipo->nome == $client->tipo ? 'selected' : ''}} @endif value="{{$tipo->nome}}">{{$tipo->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-2">
                <label for="fonte" class="form-label">Canale Mkt @error('fonte') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" aria-label="Default select example" name="fonte" id="fonte">
                    <option selected></option>
                    @foreach($canali as $canale)
                        <option @if(isset($client->nome)) {{$canale->name == $client->fonte ? 'selected' : ''}} @endif value="{{$canale->name}}">{{$canale->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-2">
                <label for="fonte" class="form-label">Data Nascita</label>
                <input type="date" @if(isset($client->nome)) value="{{$client->datanascita}}" @endif class="form-control" name="datanascita">
            </div>
        </div>
        @if(isset($client->nome))
            <button type="submit" class="btn btn-success">Modifica</button>
        @else
            <button type="submit" class="btn btn-primary">Inserisci</button>
        @endif
    </form>

@endsection
