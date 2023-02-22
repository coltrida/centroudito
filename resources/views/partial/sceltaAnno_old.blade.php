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
                            let saveId = 'myCat,' + 'Tom'
                            audio.forEach(function(item) {
                                $('#tabellaAudioSenzaBgt > tbody:last-child')
                                    .append('<tr><td>'+item.name+
                                        // '</td><td><input type="number" class="form-control budgtAnno" id="bgt'+item.id+'"  name="bgt'+item.id+'"></td></tr>');
                                        '</td><td><a class="btn btn-primary" onclick="localStorage.setItem('+saveId+')" href="#" title="elimina"> <i class="fas fa-fw fa-arrow-alt-circle-left"></i> </a></td></tr>');
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
                                let linkElimina = window.location.origin + '/admin/budget/elimina/' + item.molti_budget[0].id
                                $('#tabellaAudioConBgt > tbody:last-child').append('<tr><td>'+item.name+
                                    '</td><td>'+item.molti_budget[0].gennaio+
                                    '</td><td>'+item.molti_budget[0].febbraio+
                                    '</td><td>'+item.molti_budget[0].marzo+
                                    '</td><td>'+item.molti_budget[0].aprile+
                                    '</td><td>'+item.molti_budget[0].maggio+
                                    '</td><td>'+item.molti_budget[0].giugno+
                                    '</td><td>'+item.molti_budget[0].luglio+
                                    '</td><td>'+item.molti_budget[0].agosto+
                                    '</td><td>'+item.molti_budget[0].settembre+
                                    '</td><td>'+item.molti_budget[0].ottobre+
                                    '</td><td>'+item.molti_budget[0].novembre+
                                    '</td><td>'+item.molti_budget[0].dicembre+
                                    '</td><td><a class="btn btn-danger" href="'+linkElimina+'" title="elimina"><i class="fas fa-fw fa-trash"></i></a></td></tr>');
                            })
                        }
                    }
                )
            });
        });
    </script>
@stop
