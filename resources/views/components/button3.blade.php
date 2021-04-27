<div class="flex space-x-1 justify-around">
    {{--<a href="--}}{{--{{ route('users.show', [$name]) }}--}}{{--" target="_blank" class="p-1 text-teal-600 hover:bg-teal-600 hover:text-white rounded">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
    </a>

    <a href="--}}{{--{{ route('users.edit', [$id]) }}--}}{{--" target="_blank" class="p-1 text-blue-600 hover:bg-blue-600 hover:text-white rounded">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
    </a>--}}

    {{--<button wire:click="delete({{ $id }})" class="p-1 text-red-600 hover:bg-red-600 hover:text-white rounded">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
    </button>--}}

    <a href="#" class="btn btn-sm btn-primary mr-1"
            style="box-shadow: 2px 2px 4px #000000;"
            data-bs-toggle="modal"
            data-bs-target="#infoModal"
            title="informazioni">
        {{ $id }}
    </a>
    <a href="#" class="btn btn-sm btn-success mr-1"
            title="ricontatta"
            data-bs-toggle="modal"
            data-bs-target="#callModal"
            style="box-shadow: 2px 2px 4px #000000;">
                <i class="fas fa-phone"></i>
    </a>
    <a href="#" class="btn btn-sm btn-warning mr-1" title="note" style="box-shadow: 2px 2px 4px #000000;">
        <i class="far fa-sticky-note"></i>
    </a>
    <a href="#" class="btn btn-sm mr-1" style="background-color: #c2a449; box-shadow: 2px 2px 4px #000000;" title="prove">
        <i class="fas fa-assistive-listening-systems"></i>
    </a>
    <a href="#" class="btn btn-sm" style="background-color: #9153c2; box-shadow: 2px 2px 4px #000000;" title="modifica">
        <i class="fas fa-edit"></i>
    </a>
</div>

<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$name}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="callModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Fissare recall per: {{$name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('client.recall')}}" method="POST">
                @csrf
            <div class="modal-body">

                    <div class="modal-body">
                        <input type="hidden" name="id_client" value="{{$id}}">
                        <input type="date" name="recall"  {{--value="{{$client->datarecall ? $client->datarecall : ''}}"--}} >
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="submit" class="btn btn-primary">Inserisci recall</button>
            </div>
            </form>
        </div>
    </div>
</div>

@if (session()->has('message'))
<div class="modal fade" id="messaggioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Recall</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="modal-body">

                    <div class="modal-body">
                        {{ session('message') }}
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-primary">Inserisci recall</button>
                </div>
        </div>
    </div>
</div>
@endif

{{--<div class="modal fade" id="callModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nomeRecall"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id_cliente" name="id_cliente">
                    <input type="date" name="recall" id="recall" --}}{{--value="{{$client->datarecall ? $client->datarecall : ''}}"--}}{{-- >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
            </form>
        </div>
    </div>
</div>--}}
