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
            <form action="{{route('admin.budget.sceltaAnno')}}" name="formAnno" method="post">
                @csrf
                <select class="form-select border-dark" aria-label="Floating label select example" name="anno" id="anno" onchange="this.form.submit()">
                    <option selected></option>
                    <option value="2023" {{isset($anno) && $anno == '2023' ? 'selected' : ''}}>2023</option>
                    <option value="2022" {{isset($anno) && $anno == '2022' ? 'selected' : ''}}>2022</option>
                </select>
                <label for="anno" class="ml-2 text-gray-600">Anno</label>
            </form>
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
                    @isset($anno)
                        @foreach($audioSenzaBgt as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    <a id="audio{{$item->id}}" class="btn btn-primary seleziona" href="#" title="seleziona">
                                        <i class="fas fa-fw fa-arrow-alt-circle-left"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                </tbody>
            </table>
        </div>
        <div class="col-9">
            <form action="{{route('admin.budget.salva')}}" method="post">
                @csrf
                <div class="row">
                    @for($i=0; $i<6; $i++)
                    <div class="form-floating col">
                        <input type="hidden" name="mese[]">
                        <input type="number" value=0 class="form-control percentuale"  placeholder="name@example.com">
                        <label for="mese{{$i}}" class="ml-2 text-gray-600"
                               id="{{\Carbon\Carbon::create(2014, 5, 30, 0, 0, 0)->locale('it')->firstOfYear()->addMonths($i)->shortMonthName}}">
                            {{\Carbon\Carbon::create(2014, 5, 30, 0, 0, 0)->locale('it')->firstOfYear()->addMonths($i)->shortMonthName}}
                        </label>
                    </div>
                    @endfor
{{--                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="gennaio" name="gennaio" placeholder="name@example.com">
                        <label for="gennaio" class="ml-2 text-gray-600" id="genResult" >GEN</label>
                    </div>
                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="febbraio" name="febbraio" placeholder="name@example.com">
                        <label for="febbraio" class="ml-2 text-gray-600" id="febResult">FEB</label>
                    </div>
                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="marzo" name="marzo" placeholder="name@example.com">
                        <label for="marzo" class="ml-2 text-gray-600" id="marResult">MAR</label>
                    </div>
                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="aprile" name="aprile" placeholder="name@example.com">
                        <label for="aprile" class="ml-2 text-gray-600" id="aprResult">APR</label>
                    </div>
                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="maggio" name="maggio" placeholder="name@example.com">
                        <label for="maggio" class="ml-2 text-gray-600" id="magResult">MAG</label>
                    </div>
                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="giugno" name="giugno" placeholder="name@example.com">
                        <label for="giugno" class="ml-2 text-gray-600" id="giuResult">GIU</label>
                    </div>--}}
                 </div>
                <div class="row mt-2">
                    @for($i=6; $i<12; $i++)
                        <div class="form-floating col">
                            <input type="hidden" name="mese[]">
                            <input type="number" value=0 class="form-control percentuale"  placeholder="name@example.com">
                            <label for="mese{{$i}}" class="ml-2 text-gray-600"
                                   id="{{\Carbon\Carbon::create(2014, 5, 30, 0, 0, 0)->locale('it')->firstOfYear()->addMonths($i)->shortMonthName}}">
                                {{\Carbon\Carbon::create(2014, 5, 30, 0, 0, 0)->locale('it')->firstOfYear()->addMonths($i)->shortMonthName}}
                            </label>
                        </div>
                    @endfor
                    {{--<div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="luglio" name="luglio" placeholder="name@example.com">
                        <label for="luglio" class="ml-2 text-gray-600" id="lugResult">LUG</label>
                    </div>
                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="agosto" name="agosto" placeholder="name@example.com">
                        <label for="agosto" class="ml-2 text-gray-600" id="agoResult">AGO</label>
                    </div>
                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="settembre" name="settembre" placeholder="name@example.com">
                        <label for="settembre" class="ml-2 text-gray-600" id="setResult">SET</label>
                    </div>
                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="ottobre" name="ottobre" placeholder="name@example.com">
                        <label for="ottobre" class="ml-2 text-gray-600" id="ottResult">OTT</label>
                    </div>
                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="novembre" name="novembre" placeholder="name@example.com">
                        <label for="novembre" class="ml-2 text-gray-600" id="novResult">NOV</label>
                    </div>
                    <div class="form-floating col">
                        <input type="number" value=0 class="form-control percentuale" id="dicembre" name="dicembre" placeholder="name@example.com">
                        <label for="dicembre" class="ml-2 text-gray-600" id="dicResult">DIC</label>
                    </div>--}}
                </div>
                <div class="form-floating my-3">
                    <div class="row">
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary ml-2">Assegna</button>
                        </div>
                        <div class="form-floating col-2" style="display: none" id="mostraBudget">
                            <input type="number" class="form-control border-dark" id="budget" name="budgetAnno" placeholder="name@example.com">
                            <label for="budget" class="ml-2 text-gray-600" >Budget</label>
                        </div>
                        <div class="col-4">
                            Verifica Bgt: <span id="verificaBgt">0</span>
                        </div>
                    </div>
                    <input type="hidden" id="audioSelezionato" name="idAudio">
                    <input type="hidden" id="annoSelezionato" name="anno" value="{{isset($anno) ? $anno : 0}}">
                </div>
            </form>
        </div>

        <table class="table table-striped mx-2" id="tabellaAudioConBgt">
            <thead class="table-dark">
            <th scope="col">Audio con Bgt</th>
            <th scope="col">BGT</th>
            <th scope="col">GEN</th>
            <th scope="col">FEB</th>
            <th scope="col">MAR</th>
            <th scope="col">APR</th>
            <th scope="col">MAG</th>
            <th scope="col">GIU</th>
            <th scope="col">LUG</th>
            <th scope="col">AGO</th>
            <th scope="col">SET</th>
            <th scope="col">OTT</th>
            <th scope="col">NOV</th>
            <th scope="col">DIC</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </thead>
            <tbody class="table-group-divider">
            @isset($anno)
                @foreach($audioConBgt as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td style="background: yellow">{{$item->moltiBudget[0]->budgetAnno}}</td>
                        <td>{{$item->moltiBudget[0]->gennaio}}</td>
                        <td>{{$item->moltiBudget[0]->febbraio}}</td>
                        <td>{{$item->moltiBudget[0]->marzo}}</td>
                        <td>{{$item->moltiBudget[0]->aprile}}</td>
                        <td>{{$item->moltiBudget[0]->maggio}}</td>
                        <td>{{$item->moltiBudget[0]->giugno}}</td>
                        <td>{{$item->moltiBudget[0]->luglio}}</td>
                        <td>{{$item->moltiBudget[0]->agosto}}</td>
                        <td>{{$item->moltiBudget[0]->settembre}}</td>
                        <td>{{$item->moltiBudget[0]->ottobre}}</td>
                        <td>{{$item->moltiBudget[0]->novembre}}</td>
                        <td>{{$item->moltiBudget[0]->dicembre}}</td>
                        <td>
                            <a class="btn btn-danger" href="{{route('admin.budget.elimina', $item->moltiBudget[0]->id)}}" title="elimina">
                                <i class="fas fa-fw fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>

@endsection

@extends('partial.gestioneModal')
@extends('partial.calcoloBgtMensileVerifica')
{{--@extends('partial.sceltaAnno')--}}


