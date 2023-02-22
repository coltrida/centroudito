@section('footer')
    @parent
    <script type="text/javascript">
        $('document').ready(function () {

            $('#anno').change(function (evt) {
                document.forms[formAnno].submit();
            });
        });
    </script>
@stop
