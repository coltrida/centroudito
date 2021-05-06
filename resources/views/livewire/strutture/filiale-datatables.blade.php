<div class="flex justify-center" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="w-10/12">

        <div class="row pr-5">
            <div class="col">
                <h1 class=" text-3xl">Filiali</h1>
            </div>
            @if (session()->has('message'))
                <div class="col p-2 bg-green-200 text-green-800 rounded shadow-sm">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <form class="my-4" wire:submit.prevent="addFiliale">
            <div class="flex">
                <input wire:model.lazy="nome" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Nome Filiale">
                <input wire:model.lazy="indirizzo" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Indirizzo Filiale">
                <input wire:model.lazy="telefono" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="telefono">
            </div>
            <div class="flex">
                <input wire:model.lazy="citta" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="città">
                <input wire:model.lazy="cap" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="cap">
                <input wire:model.lazy="provincia" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="provincia">
            </div>
                <div class="py-2">
                <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Aggiungi</button>
            </div>
        </form>
        @foreach($filiali as $item)
            <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
                <div class="row justify-between my-1 align-items-center">
                    <div class="col">
                        <p class="font-bold">{{$item->nome}}</p>
                    </div>
                    <div class="col-3">
                        <p class="font-bold">{{$item->indirizzo}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">{{$item->telefono}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">{{$item->citta}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">{{$item->cap}}</p>
                    </div>
                    <div class="col-1">
                        <p class="font-bold">{{$item->provincia}}</p>
                    </div>
                    <div class="col-1">
                        <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$item->id}})"></i>
                    </div>

                </div>

                <div class="row justify-between my-1 align-items-center">
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                    <div class="col">fatturato</div>
                </div>

            </div>
        @endforeach

    </div>
</div>

<script>

</script>


