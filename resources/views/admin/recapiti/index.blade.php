@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Recapiti</h1>
        </div>
        <div>
            <a class="btn btn-success" href="{{route('admin.recapiti.aggiungi')}}">Aggiungi</a>
        </div>

    </div>

    <table class="table table-striped">
        <thead class="table-dark">
            <th scope="col">Codice</th>
            <th scope="col">Nome</th>
            <th scope="col">indirizzo</th>
            <th scope="col">citta</th>
            <th scope="col">telefono</th>
            <th scope="col">cap</th>
            <th scope="col">provincia</th>
            <th scope="col">info</th>
            <th scope="col">filiale</th>
            <th scope="col">Actions</th>
        </thead>
        <tbody class="table-group-divider">
            @foreach($recapiti as $item)
                <tr>
                    <td>{{$item->codiceIdentificativo}}</td>
                    <td>{{$item->nome}}</td>
                    <td>{{$item->indirizzo}}</td>
                    <td>{{$item->citta}}</td>
                    <td>{{$item->telefono}}</td>
                    <td>{{$item->cap}}</td>
                    <td>{{$item->provincia}}</td>
                    <td>{{$item->info}}</td>
                    <td>{{$item->filiale->nome}}</td>
                    <td>
                        <a class="btn btn-danger" href="{{route('admin.recapiti.elimina', $item->id)}}" title="elimina">
                            <i class="fas fa-fw fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



@endsection

