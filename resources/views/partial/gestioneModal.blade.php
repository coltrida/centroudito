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

        });
    </script>
@stop
