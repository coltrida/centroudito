<div>

    <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
        <div class="row justify-between my-1 align-items-start">
            <div class="col-4">
                <p class="font-bold text-lg ">Audioprotesisti</p>
                @foreach($audioprotesisti as $audioprotesista)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">{{$audioprotesista->name}}</div>
                                <div class="text-right">
                                    <div>Prove in corso: {{$audioprotesista->prova_count}}</div>
                                        @foreach($audioprotesista->provaInCorso as $prove)
                                            <div class="row">
                                                <div class="col"> {{$prove->inizio_prova}} </div>
                                                <div class="col"> € {{$prove->tot}} </div>
                                                <div class="col"> {{$prove->client_id}} </div>
                                            </div>
                                        @endforeach
                                    <div>Fatturato mese: € {{$audioprotesista->prova_finalizzata_sum_tot}}</div>
                                        @foreach($audioprotesista->provaFinalizzata as $prove)
                                            <div class="row">
                                                <div class="col"> {{$prove->inizio_prova}} </div>
                                                <div class="col"> € {{$prove->tot}} </div>
                                                <div class="col"> {{$prove->client_id}} </div>
                                            </div>
                                        @endforeach
                                    <div>Target mese: {{isset($audioprotesista->budget_id) ? ( (int)$audioprotesista->budget->budgetAnno * (int)$audioprotesista->budget->target ) / 100 : null}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-4">
                <p class="font-bold text-lg">Filiali</p>
                @foreach($filiali as $filiale)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">{{$filiale->nome}}</div>
                                <div class="text-right">
                                    <div>Fatturato mese:</div>
                                    <div>Costi mese:</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-4">
                <p class="font-bold text-lg">Amministrativi</p>
                @foreach($amministrativi as $amministrativo)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">{{$amministrativo->name}}</div>
                                <div class="text-right">
                                    <div>Nr. telefonate:</div>
                                    <div>Target mese:</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
        <div class="row justify-between my-1 align-items-start">
            <div class="col-4">
                <p class="font-bold text-lg">Target e Premi Trimestre</p>
                {{--@foreach($amministrativi as $amministrativo)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">{{$amministrativo->name}}</div>
                                <div class="text-right">
                                    <div>Nr. telefonate:</div>
                                    <div>Target mese:</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach--}}
            </div>

            <div class="col-4">
                <p class="font-bold text-lg">Target e Premi Annuali</p>
                {{--@foreach($amministrativi as $amministrativo)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">{{$amministrativo->name}}</div>
                                <div class="text-right">
                                    <div>Nr. telefonate:</div>
                                    <div>Target mese:</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach--}}
            </div>
            <div class="col-4">
                <p class="font-bold text-lg">Utili</p>
                {{--@foreach($amministrativi as $amministrativo)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">{{$amministrativo->name}}</div>
                                <div class="text-right">
                                    <div>Nr. telefonate:</div>
                                    <div>Target mese:</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach--}}
            </div>
        </div>
    </div>

</div>

