<div class="flex justify-center" xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="w-10/12">
        @if (session()->has('message'))
            <div class="p-3 bg-green-200 text-green-800 rounded shadow-sm">
                {{ session('message') }}
            </div>
        @endif

        <h1 class="text-3xl">Canali Marketing</h1>

        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror

        <form class="my-4" wire:submit.prevent="addCanale">
            <input wire:model.lazy="newCanale" type="text" style="color: black" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Inserisci Canale Marketing">
            <div class="py-2">
                <button type="submit" class="p-2 bg-blue-500 w-20 rounded shadow text-white">Aggiungi</button>
            </div>
        </form>
        @foreach($canali as $item)
             <div class="rounded border p-3 my-2" style="background-color: #124874; box-shadow: 2px 2px 4px #000000;">
                <div class="flex justify-between my-1 align-items-center">
                    <div class="flex">
                        <p class="font-bold">{{$item->name}}</p>
                    </div>
                    <i class="fas fa-times text-red-200 hover:text-red-600 cursor-pointer" wire:click="remove({{$item->id}})"></i>
                </div>
            </div>
        @endforeach

    </div>
</div>

<script>

</script>

