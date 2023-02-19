@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Aggiungi Personale</h1>
        </div>
        <div>
            <a class="btn btn-warning" href="{{route('admin.personale')}}">Annulla</a>
        </div>
    </div>

    <form action="{{route('admin.personale.salva')}}" method="post">
    @csrf

    <div class="row">
        <div class="form-floating col-3">
            <input type="text" class="form-control" id="name" name="name">
            <label for="name">Nome</label>
        </div>

        <div class="form-floating col-5">
            <input type="email" class="form-control" id="email" name="email">
            <label for="email">email</label>
        </div>

        <div class="form-floating col-4">
            <select class="form-control" aria-label="Default select example" name="ruolo_id">
                <option selected></option>
                @foreach($ruoli as $ruolo)
                    <option value={{$ruolo->id}}>{{$ruolo->nome}}</option>
                @endforeach
            </select>
            <label for="email">Ruolo</label>
        </div>

    </div>

        <button type="submit" class="btn btn-primary">Inserisci</button>

    </form>

@endsection
