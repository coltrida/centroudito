<div  id="callModal" @if($visibile) style="display: none" @else style="display: block"  @endif tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 500px; box-shadow: 2px 2px 4px #000000;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Fissare recall per: {{$clientName}} {{$clientCognome}}</h5>
                <button type="button" class="btn-close" wire:click="closeModal()" aria-label="Close"></button>
            </div>
            <form action="{{route('client.recall')}}" method="POST">
                @csrf
                <div class="modal-body">

                    <div class="modal-body">
                        <input type="hidden" name="id_client" value="{{$clientId}}">
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
