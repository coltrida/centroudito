@section('footer')
    @parent
    <script type="text/javascript">
        $('document').ready(function () {

            $('#anni').change(function (evt) {
                let urlSenzaBgt = window.location.origin + '/admin/budget/audioSenzaBgt';
                let urlConBgt = window.location.origin + '/admin/budget/audioConBgt';

                $('#tabellaAudioSenzaBgt > tbody').empty();
                $('#tabellaAudioConBgt > tbody').empty();

                $.ajax(urlSenzaBgt,
                    {
                        method: 'POST',
                        data: {
                            'anno' : this.value,
                            '_token': '{{csrf_token()}}',
                        },
                        complete: function (resp) {
                            let audio = resp.responseJSON;
                            audio.forEach(function(item) {
                                $('#tabellaAudioSenzaBgt > tbody:last-child')
                                    .append('<tr><td>'+item.name+
                                        '</td><td><input type="number" class="form-control" id="bgt'+item.id+'"  name="bgt'+item.id+'"></td></tr>');
                            })
                        }
                    }
                )
                $.ajax(urlConBgt,
                    {
                        method: 'POST',
                        data: {
                            'anno' : this.value,
                            '_token': '{{csrf_token()}}',
                        },
                        complete: function (resp) {
                            let audio = resp.responseJSON;
                            audio.forEach(function(item) {
                                $('#tabellaAudioConBgt > tbody:last-child').append('<tr><td>'+item.name+'</td></tr>');
                            })
                        }
                    }
                )
            });

        });
    </script>
@stop
