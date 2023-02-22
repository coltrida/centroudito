@section('footer')
    @parent
    <script type="text/javascript">
        $('document').ready(function () {

            $('.percentuale').prop('disabled', true);

            $('.seleziona').click(function (evt) {
                $('#mostraBudget').css('display', 'block');
                $('#budget').val(0);
                $('.percentuale').val(0);
                $('.percentuale').prop('disabled', false);
                $('#tabellaAudioSenzaBgt > tbody > tr').css('background', '');
                $(this.parentNode.parentNode).css('background', '#74ea06');
                let idSelezionato = evt.currentTarget.id.substring(5);
                $('#audioSelezionato').val(idSelezionato);
            });

            $('.percentuale').change(function (evt) {
                let totaleVerifica = 0;
                $('.percentuale').each(function( ele ) {
                    totaleVerifica += ( parseInt($('#budget').val()) * parseInt(this.value) ) / 100;
                });
                $('#verificaBgt').html(totaleVerifica);
                let nuovoLavel = $(this).next().attr('id') + ' - €' + ( parseInt($('#budget').val()) * parseInt(this.value) ) / 100;
                $(this).next().html(nuovoLavel);
                $(this).prev().val(( parseInt($('#budget').val()) * parseInt(this.value) ) / 100);
            });

            $('#budget').change(function (evt) {
                let totaleVerifica = 0;
                $('.percentuale').each(function( ele ) {
                    totaleVerifica += ( parseInt($('#budget').val()) * parseInt(this.value) ) / 100;
                    let nuovoLavel = $(this).next().attr('id') + ' - €' + ( parseInt($('#budget').val()) * parseInt(this.value) ) / 100;
                    $(this).next().html(nuovoLavel);
                    $(this).prev().val(( parseInt($('#budget').val()) * parseInt(this.value) ) / 100);
                });
                $('#verificaBgt').html(totaleVerifica);
            });

        })
    </script>
@stop
