@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Personale</h1>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('admin.personale.aggiungi')}}">Aggiungi</a>
        </div>

    </div>

    <table class="table table-striped">
        <thead class="table-dark">
        <th scope="col">Nome</th>
        <th scope="col">email</th>
        <th scope="col">Ruolo</th>
        <th scope="col">Actions</th>
        </thead>
        <tbody class="table-group-divider">
        @foreach($users as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->email}}</td>
                <td>{{$item->ruolo->nome}}</td>
                <td>
                    <a class="btn btn-danger" href="{{route('admin.personale.elimina', $item->id)}}" title="elimina">
                        <i class="fas fa-fw fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
