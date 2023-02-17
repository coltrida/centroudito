@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Filiali</h1>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('admin.index')}}">Aggiungi</a>
        </div>

    </div>

    <table class="table table-striped-columns">
        <thead class="table-dark">
            <th scope="col">Codice</th>
            <th scope="col">Nome</th>
            <th scope="col">indirizzo</th>
            <th scope="col">citta</th>
            <th scope="col">telefono</th>
            <th scope="col">cap</th>
            <th scope="col">provincia</th>
            <th scope="col">info</th>
        </thead>
        <tbody class="table-group-divider">
            @foreach($filiali as $filiale)
                <tr>
                    <td>{{$filiale->codiceIdentificativo}}</td>
                    <td>{{$filiale->nome}}</td>
                    <td>{{$filiale->indirizzo}}</td>
                    <td>{{$filiale->citta}}</td>
                    <td>{{$filiale->telefono}}</td>
                    <td>{{$filiale->cap}}</td>
                    <td>{{$filiale->provincia}}</td>
                    <td>{{$filiale->info}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
