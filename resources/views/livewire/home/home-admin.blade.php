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
                                    <div>Prove in corso:</div>
                                    <div>Fatturato mese:</div>
                                    <div>Target mese:</div>
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
</div>

