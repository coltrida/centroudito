@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Fornitori</h1>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('admin.fornitore.aggiungi')}}">Aggiungi</a>
        </div>

    </div>

    <table class="table table-striped">
        <thead class="table-dark">
        <th scope="col">Nome</th>
        <th scope="col">Indirizzo</th>
        <th scope="col">Città</th>
        <th scope="col">Cap</th>
        <th scope="col">PR</th>
        <th scope="col">Telefono</th>
        <th scope="col">email</th>
        <th scope="col">pec</th>
        <th scope="col">cod un</th>
        <th scope="col">Actions</th>
        </thead>
        <tbody class="table-group-divider">
        @foreach($fornitori as $item)
            <tr>
                <td>{{$item->nome}}</td>
                <td>{{$item->indirizzo}}</td>
                <td>{{$item->citta}}</td>
                <td>{{$item->cap}}</td>
                <td>{{$item->provincia}}</td>
                <td>{{$item->telefono}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->pec}}</td>
                <td>{{$item->univoco}}</td>
                <td>
                    <a class="btn btn-danger" href="{{route('admin.fornitore.elimina', $item->id)}}" title="elimina">
                        <i class="fas fa-fw fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
