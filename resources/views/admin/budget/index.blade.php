@extends('layouts.admin')

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

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Budget</h1>
        </div>
        <div class="form-floating mr-5">
            <select class="form-select border-dark" aria-label="Floating label select example" name="anni" id="anni">
                <option selected></option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
            </select>
            <label for="anni" class="ml-2 text-gray-600">Anno</label>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <table class="table table-striped" id="tabellaAudioSenzaBgt">
                <thead class="table-dark">
                    <th scope="col">Audio senza Bgt</th>
                    <th scope="col">Bgt</th>
                </thead>
                <tbody class="table-group-divider">

                </tbody>
            </table>
        </div>
        <div class="col-9">
            <form action="{{route('admin.marketing.salva')}}" method="post">
                @csrf
                <div class="row">
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="gennaio" name="gennaio" placeholder="name@example.com">
                        <label for="gennaio" class="ml-2 text-gray-600">GEN</label>
                    </div>
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="febbraio" name="febbraio" placeholder="name@example.com">
                        <label for="febbraio" class="ml-2 text-gray-600">FEB</label>
                    </div>
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="marzo" name="marzo" placeholder="name@example.com">
                        <label for="marzo" class="ml-2 text-gray-600">MAR</label>
                    </div>
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="aprile" name="aprile" placeholder="name@example.com">
                        <label for="aprile" class="ml-2 text-gray-600">APR</label>
                    </div>
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="maggio" name="maggio" placeholder="name@example.com">
                        <label for="maggio" class="ml-2 text-gray-600">MAG</label>
                    </div>
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="giugno" name="giugno" placeholder="name@example.com">
                        <label for="giugno" class="ml-2 text-gray-600">GIU</label>
                    </div>
                 </div>
                <div class="row mt-2">
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="luglio" name="luglio" placeholder="name@example.com">
                        <label for="luglio" class="ml-2 text-gray-600">LUG</label>
                    </div>
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="agosto" name="agosto" placeholder="name@example.com">
                        <label for="agosto" class="ml-2 text-gray-600">AGO</label>
                    </div>
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="settembre" name="settembre" placeholder="name@example.com">
                        <label for="settembre" class="ml-2 text-gray-600">SET</label>
                    </div>
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="ottobre" name="ottobre" placeholder="name@example.com">
                        <label for="ottobre" class="ml-2 text-gray-600">OTT</label>
                    </div>
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="novembre" name="novembre" placeholder="name@example.com">
                        <label for="novembre" class="ml-2 text-gray-600">NOV</label>
                    </div>
                    <div class="form-floating col">
                        <input type="text" class="form-control" id="dicembre" name="dicembre" placeholder="name@example.com">
                        <label for="dicembre" class="ml-2 text-gray-600">DIC</label>
                    </div>
                </div>
                <div class="form-floating my-3">
                    <button type="submit" class="btn btn-primary ml-2">Assegna</button>
                </div>
            </form>

            <table class="table table-striped" id="tabellaAudioConBgt">
                <thead class="table-dark">
                <th scope="col">Audio con Bgt</th>
                </thead>
                <tbody class="table-group-divider">

                </tbody>
            </table>

        </div>
    </div>

@endsection

@extends('partial.gestioneModal')
@extends('partial.sceltaAnno')


