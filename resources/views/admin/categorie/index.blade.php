@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Categorie</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <table class="table table-striped">
                <thead class="table-dark">
                <th scope="col">Nome</th>
                <th scope="col">Actions</th>
                </thead>
                <tbody class="table-group-divider">
                @foreach($categorie as $item)
                    <tr>
                        <td>{{$item->nome}}</td>
                        <td>
                            <a class="btn btn-danger" href="{{route('admin.categoria.elimina', $item->id)}}" title="elimina">
                                <i class="fas fa-fw fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <form action="{{route('admin.categoria.salva')}}" method="post">
                @csrf
                <div class="row">
                    <div class="form-floating col-8">
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="name@example.com">
                        <label for="nome" class="ml-2 text-gray-600">Nome Categoria</label>
                    </div>
                    <div class="form-floating col-4">
                        <button type="submit" class="btn btn-primary ml-2">Inserisci</button>
                    </div>

                </div>

            </form>
        </div>
    </div>




@endsection

