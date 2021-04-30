<div>

    <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
        <div class="row justify-between my-1 align-items-start">
            <div class="col-2">
                <p class="font-bold text-lg ">Audio</p>
                {{--@foreach($filiali as $filiale)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="row">
                                    <div class="col-2">
                                        <input type="radio" wire:model="filialeSel_id" class="form-check-input" value="{{$filiale->id}}">
                                    </div>
                                    <div class="col-10">
                                        <p class="font-bold text-center">{{$filiale->nome}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach--}}
            </div>
            <div class="col-3">
                <p class="font-bold text-lg">Audioprotesisti</p>
                {{--@foreach($audioprotesisti as $audioprotesista)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="row">
                                    <div class="col-2">
                                        <input type="checkbox" wire:model="personale" class="form-check-input" value="{{$audioprotesista->id}}">
                                    </div>
                                    <div class="col-10">
                                        <p class="font-bold text-center">{{$audioprotesista->name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach--}}
            </div>
            <div class="col-3">
                <p class="font-bold text-lg">Amministrativi</p>
                {{--@foreach($amministrazione as $amministrativo)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <div class="row">
                                    <div class="col-2">
                                        <input type="checkbox" wire:model="personale" class="form-check-input" value="{{$amministrativo->id}}">
                                    </div>
                                    <div class="col-10">
                                        <p class="font-bold text-center">{{$amministrativo->name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach--}}
            </div>
            <div class="col-3">
                <p class="font-bold text-lg">Associazioni</p>
                {{--@foreach($filiali as $filiale)
                    <div class="rounded border p-1 my-2" style="background-color: #537429; box-shadow: 2px 2px 4px #000000;">
                        <div class="row justify-between my-1 align-items-center">
                            <div class="col">
                                <p class="font-bold text-center">{{$filiale->nome}}</p>
                                @foreach($filiale->users as $user)
                                    <div class="rounded border p-1 my-2" style="color: black; background-color: #f8ab00; box-shadow: 2px 2px 4px #000000;">
                                        <div class="row justify-between my-1 align-items-center">
                                            <div class="col">
                                                <p class="font-bold text-center">{{$user->name}}</p>
                                            </div>
                                            <div class="col-1 pr-6">
                                                <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="dissocia({{$user->pivot->id}})"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach--}}
            </div>
        </div>
    </div>
</div>

