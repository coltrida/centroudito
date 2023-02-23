@section('footer')
    @parent
    <script type="text/javascript">
        $('document').ready(function () {

            let message = "{{ Session::get('message') }}";
            if( message ){
                $('#exampleModal').modal('show');
            }

            setTimeout(function() {
                $('#exampleModal').modal('hide');
            }, 3000);

            $('.btn-close').on('click', function (evt) {
                evt.preventDefault();
                $('#exampleModal').modal('hide');
            });

            $('.fa-trash').on('click', function (evt) {
                evt.preventDefault();
                let client = JSON.parse($(this).attr('id'))
                $('#nomeClienteElimina').html(client.nome + ' ' + client.cognome);
                $('#idClientElimina').val(client.id);
            });

        });
    </script>
@stop
