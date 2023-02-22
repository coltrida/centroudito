@extends('layouts.admin')

@section('content')
    <!-- Page Heading -->
    <form action="{{route('admin.filiali.eseguiAssociaAudio')}}" method="post">
        @csrf
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Associazioni</h1>
        </div>
        <div>
            <button type="submit" class="btn btn-primary mt-5">Associa</button>
        </div>
    </div>

    <div class="row">
        <div class="col-4">
            <h2>Personale</h2>
            <table class="table table-striped">
                <thead class="table-dark">
                <th scope="col">Nome</th>
                <th scope="col">Actions</th>
                </thead>
                <tbody class="table-group-divider">
                @foreach($utenti as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>
                            <input name="userId" class="form-check-input mt-0" type="radio" value="{{$item->id}}" aria-label="Radio button for following text input">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <h2>Filiali</h2>
            <table class="table table-striped">
                <thead class="table-dark">
                <th scope="col">Nome</th>
                <th scope="col">Actions</th>
                </thead>
                <tbody class="table-group-divider">
                @foreach($associazioni as $item)
                    <tr>
                        <td>{{$item->nome}}</td>
                        <td>
                            <input name="filiali[]" class="form-check-input mt-0" type="checkbox" value="{{$item->id}}" aria-label="Checkbox for following text input">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-4">
            <h2>Associazioni</h2>
            <table class="table table-striped">
                <thead class="table-dark">
                <th scope="col">Nome</th>
                <th scope="col">Actions</th>
                </thead>
                <tbody class="table-group-divider">
                @foreach($associazioni as $item)
                    <tr>
                        <td>{{$item->nome}}</td>
                        <td>
                            @foreach($item->users as $user)
                            <div class="row mb-1">
                                <div class="col-8" >
                                        {{$user->name}}
                                </div>
                                <div class="col-4">
                                    <a class="btn btn-sm btn-danger" href="{{route('admin.filiali.eliminaAssociazione', $user->pivot->id)}}" title="elimina">
                                        <i class="fas fa-fw fa-trash"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    </form>



@endsection

