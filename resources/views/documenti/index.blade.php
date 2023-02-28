@extends('layouts.style')

@section('content')
    <div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    </div>


        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">
                    Documenti del Paziente {{$client->nome.' '.$client->cognome}}
                </h1>
            </div>
            <div>
                <a class="btn btn-success" href="{{route('clients', $client->filiale_id)}}">Annulla</a>
            </div>
        </div>
        <div class="container">
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead class="table-dark">
                <th scope="col">Data</th>
                <th scope="col">Tipo</th>
                <th scope="col">Link</th>
                <th scope="col">
                    <a href="{{route('aggiungiDocumento', $client->id)}}" class="btn btn-primary" title="Aggiungi documento">
                        <i class="fas fa-fw fa-plus"></i>
                    </a>
                </th>
                </thead>
                <tbody class="table-group-divider">
                @foreach($documenti as $item)
                    <tr>
                        <td>{{$item->created_at->format('d/m/Y')}}</td>
                        <td>{{$item->tipo}}</td>
                        <td>
                            <a href="{{asset($item->link)}}" target="_blank">
                                link
                            </a>
                        </td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                {{--<tr>
                    <td colspan="16">
                        {{$clients->links()}}
                    </td>
                </tr>--}}
                </tbody>
            </table>
        </div>
    </div>
    <!-- Page Heading -->


@endsection

@extends('partial.gestioneModal')

