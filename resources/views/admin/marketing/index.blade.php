@extends('layouts.admin')

@section('content')

    <div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Canali Marketing</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <table class="table table-striped">
                <thead class="table-dark">
                <th scope="col">Nome</th>
                <th scope="col">Codice</th>
                <th scope="col">Actions</th>
                </thead>
                <tbody class="table-group-divider">
                @foreach($canali as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->cod}}</td>
                        <td>
                            <a class="btn btn-danger" href="{{route('admin.marketing.elimina', $item->id)}}" title="elimina">
                                <i class="fas fa-fw fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-6">
            <form action="{{route('admin.marketing.salva')}}" method="post">
                @csrf
                <div class="row">
                    <div class="form-floating col-6">
                        <input type="text" class="form-control" id="name" name="name" placeholder="name@example.com">
                        <label for="name" class="ml-2 text-gray-600">Canale mkt</label>
                    </div>
                    <div class="form-floating col-3">
                        <input type="text" class="form-control" id="cod" name="cod" placeholder="name@example.com">
                        <label for="cod" class="ml-2 text-gray-600">codice</label>
                    </div>
                    <div class="form-floating col-3">
                        <button type="submit" class="btn btn-primary ml-2">Inserisci</button>
                    </div>

                </div>

            </form>
        </div>
    </div>

@endsection

@section('footer')
    @parent
    <script type="text/javascript">
        $('document').ready(function () {
            let message = "{{ Session::get('message') }}";
            if( message ){
                $('#exampleModal').modal('show');
            }

            setTimeout(function() {
                $('#exampleModal').modal('hide');
            }, 3000);

            $('.btn-close').on('click', function (evt) {
                evt.preventDefault();
                $('#exampleModal').modal('hide');
            });
        });
    </script>
@stop

