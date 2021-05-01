<div class="flex justify-center" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="w-10/12">

        <div class="row pr-5">
            <div class="col">
                <h1 class=" text-3xl">Magazzino</h1>
            </div>
            @if (session()->has('message'))
                <div class="col p-2 bg-green-200 text-green-800 rounded shadow-sm">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <form class="my-4" wire:submit.prevent="aggiungi">
            <div class="row">
                <div class="col">
                    <select wire:model="idFornitore" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                        <option selected value=''>Seleziona Fornitore</option>
                        @foreach($fornitori as $item)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select wire:model="idListino" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                        <option selected>listino</option>
                        @foreach($listino as $item)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <input wire:model.lazy="matricola" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Matricola">
                </div>
                <div class="col">
                    <select wire:model="idFiliale" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                        <option selected value="negozio">filiale</option>
                        @foreach($filiali as $item)
                            <option value="{{$item->id}}">{{$item->nome}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <select wire:model="stato" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                        <option value="filiale">filiale</option>
                        <option value="prova">prova</option>
                        <option value="vendita">vendita</option>
                    </select>
                </div>
            </div>

            <div class="py-2 flex justify-content-between">
                <div>
                    <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Aggiungi</button>
                </div>
                <div>
                    <div class="w-96 flex rounded-lg shadow-sm">
                        <div class="relative flex-grow focus-within:z-10">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" stroke="currentColor" fill="none">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input wire:model.debounce.500ms="ricerca" style="padding: 10px 0 10px 40px; color: black" class="form-input block bg-gray-50 focus:bg-white w-full rounded-md pl-10 transition ease-in-out duration-150 sm:text-sm sm:leading-5" placeholder="Search in Name">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @foreach($products as $item)
            <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
                <div class="row justify-between my-1 align-items-center">
                    <div class="col">
                        <p class="font-bold">{{$item->matricola}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">{{$item->stato}}</p>
                    </div>
                    <div class="col-2">
                        <p class="font-bold">{{$item->filiale->nome}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">€ {{$item->listino->costo}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">€ {{$item->listino->prezzolistino}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">{{$item->listino->iva}} %</p>
                    </div>
                    <div class="col">
                        <p class="font-bold">{{$item->fornitore->nome}}</p>
                    </div>
                    <div class="col-1">
                        <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$item->id}})"></i>
                    </div>

                </div>
            </div>
        @endforeach

    </div>
</div>

<script>

</script>



