@extends('stile')

@section('main')
    @if(session()->has('message'))
        <div class="alert-warning">
            {{session()->get('message')}}
        </div>
    @endif


    <form action="{{route('client.postInserisci')}}" method="post">
        @csrf
        <div class="row">
            <div class="mb-3 col-3">
                <label for="nome" class="form-label">Nome @error('nome') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="nome">
            </div>
            <div class="mb-3 col-3">
                <label for="cognome" class="form-label">Cognome @error('cognome') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" class="form-control" id="cognome" name="cognome" placeholder="cognome">
            </div>
            <div class="mb-3 col-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="telefono">
            </div>
            <div class="mb-3 col-3">
                <label for="codfisc" class="form-label">Codice Fiscale</label>
                <input type="text" class="form-control" id="codfisc" name="codfisc" placeholder="codice fiscale">
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-3">
                <label for="indirizzo" class="form-label">Indirizzo @error('indirizzo') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" class="form-control" id="indirizzo" name="indirizzo" placeholder="indirizzo">
            </div>
            <div class="mb-3 col-3">
                <label for="citta" class="form-label">Città @error('citta') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" class="form-control" id="citta" name="citta" placeholder="citta">
            </div>
            <div class="mb-3 col-2">
                <label for="cap" class="form-label">CAP @error('cap') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" class="form-control" id="cap" name="cap" placeholder="CAP">
            </div>
            <div class="mb-3 col-2">
                <label for="provincia" class="form-label">Provincia @error('provincia') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <input type="text" class="form-control" id="provincia" name="provincia" placeholder="PR">
            </div>
            <div class="mb-3 col-2">
                <label for="filiale_id" class="form-label">Filile @error('filiale_id') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" aria-label="Default select example" name="filiale_id" id="filiale_id">
                    <option selected></option>
                    @foreach($filiali as $filiale)
                        <option value="{{$filiale->id}}">{{$filiale->nome}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row">
            <div class="mb-3 col-3">
                <label for="recapito_id" class="form-label">Recapito @error('fonte') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" aria-label="Default select example" name="recapito_id" id="recapito_id">
                    <option selected></option>
                    @foreach($recapiti as $recapito)
                        <option value="{{$recapito->id}}">{{$recapito->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-4">
                <label for="mail" class="form-label">email</label>
                <input type="text" class="form-control" id="mail" name="mail" placeholder="e-mail">
            </div>
            <div class="mb-3 col-2">
                <label for="tipo" class="form-label">Tipo @error('tipo') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" aria-label="Default select example" name="tipo" id="tipo">
                    <option selected></option>
                    @foreach(config('enum.tipi') as $tipo)
                        <option value="{{$tipo}}">{{$tipo}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3 col-3">
                <label for="fonte" class="form-label">Canale Mkt @error('fonte') <span class="text-red-500 text-xs"> - {{ $message }}</span> @enderror</label>
                <select class="form-select" aria-label="Default select example" name="fonte" id="fonte">
                    <option selected></option>
                    @foreach($canali as $canale)
                        <option value="{{$canale->name}}">{{$canale->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Inserisci</button>

    </form>

@endsection
