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
        <div class="form-floating col-4">
            <input type="text" class="form-control" id="name" name="name" placeholder="name@example.com">
            <label for="name" class="ml-2 text-gray-600">Nome</label>
        </div>

        <div class="form-floating col-5">
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
            <label for="email" class="ml-2 text-gray-600">email</label>
        </div>

        <div class="form-floating col-3">
            <select class="form-select" aria-label="Floating label select example" name="ruolo_id">
                <option selected></option>
                @foreach($ruoli as $ruolo)
                    <option value={{$ruolo->id}}>{{$ruolo->nome}}</option>
                @endforeach
            </select>
            <label for="email" class="ml-2 text-gray-600">Ruolo</label>
        </div>

    </div>

        <button type="submit" class="btn btn-primary mt-5">Inserisci</button>

    </form>

@endsection
