<div>

    <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
        <div class="row justify-between my-1 align-items-start">
            <div class="col-4">
                <p class="font-bold text-lg ">Finalizzati nel mese</p>
                @foreach($finalizzati as $prova)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">Inizio Prova:{{$prova->inizio_prova}}</div>
                                <div class="text-right">
                                    <div>Cliente: {{$prova->id_client}}</div>
                                    <div>Tot: {{$prova->tot}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-4">
                <p class="font-bold text-lg ">Prove In corso</p>
                @foreach($proveInCorso as $prova)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">Inizio Prova:{{$prova->inizio_prova}}</div>
                                <div class="text-right">
                                    <div>Cliente: {{$prova->id_client}}</div>
                                    <div>Tot: {{$prova->tot}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="col-4">
                <p class="font-bold text-lg ">Appuntamenti</p>
                @foreach($proveInCorso as $prova)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="font-bold">Inizio Prova:{{$prova->inizio_prova}}</div>
                                <div class="text-right">
                                    <div>Cliente: {{$prova->id_client}}</div>
                                    <div>Tot: {{$prova->tot}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

