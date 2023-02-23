@section('footer')
    @parent
    <script type="text/javascript">
        $('document').ready(function () {

            $('#resetBtn').click(function (evt) {
                $('#testoRicerca').val('');
                $( "#ricercaForm" ).submit();
            });
        });
    </script>
@stop
