<div class="flex justify-center" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="w-10/12">

        <div class="row pr-5">
            <div class="col">
                <h1 class=" text-3xl">Amministrazione</h1>
            </div>
            @if (session()->has('message'))
                <div class="col p-2 bg-green-200 text-green-800 rounded shadow-sm">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <form class="my-4" wire:submit.prevent="addAmministrazione">
            <div class="flex">
                <input wire:model.lazy="nome" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Nome">
                <input wire:model.lazy="email" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="email">

                <select wire:model="id_filiale" class="w-full rounded border shadow p-2 mr-2 my-2" style="color: black" aria-label="Default select example">
                    <option selected>Seleziona Filiale</option>
                    @foreach($filiali as $item)
                        <option value="{{$item->id}}">{{$item->nome}}</option>
                    @endforeach
                </select>
            </div>
            <div class="py-2">
                <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Aggiungi</button>
            </div>
        </form>
        @foreach($amministrazione as $item)
            <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
                <div class="row justify-between my-1 align-items-center">
                    <div class="col">
                        <p class="font-bold text-lg">{{$item->name}}</p>
                    </div>
                    <div class="col">
                        <p class="font-bold text-lg">{{$item->email}}</p>
                    </div>
                    <div class="col-2">
                        <p class="font-bold text-lg">{{$item->filiale->nome}}</p>
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




