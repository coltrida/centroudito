<div style="border-bottom: 1px solid black; height: 180px; width: 100%">
    <div style="font-size: 14px">
        <img src="{{asset('img/logo-centroudito.jpg')}}" style="width: 200px">
    </div>
    <div style="float: right; font-size: 14px">
{{--        <div>ddt nr. {{$nuovoDDT->progressivo}} del {{$nuovoDDT->created_at->format('d-m-Y')}}</div>--}}
        <div>ddt nr. {{$nuovoDDT->progressivo}} del 22-12-2021</div>
        <br>
        <div>CENTRO UDITO GROUP</div>
        <div>VIA MARIO LALLI N.10</div>
        <div>56127 PISA (PI)</div>
        <div>P.iva IT 02349860508</div>
    </div>

</div>

<br>

<div style="border: 1px solid black; height: 130px; width: 100%; padding: 5px 2px; margin-bottom: 10px; background-color: #eeeeee">
    <div style="float: left; width: 60%; padding: 10px; font-size: 14px">
        <div style="margin-bottom: 5px"><b>Destinatario</b></div>
        {{--<div>{{$request}}</div>--}}
        <div>{{$nuovoDDT->nome_destinazione}}</div>
        <div>{{$nuovoDDT->indirizzo_destinazione}}</div>
        <div>{{$nuovoDDT->cap_destinazione}} - {{$nuovoDDT->citta_destinazione}} - {{$nuovoDDT->provincia_destinazione}}</div>
    </div>
</div>

<div style="border: 1px solid black;  width: 100%; background-color: #eeeeee; padding: 10px">
    <table style="width: 100%; margin-bottom: 40px">
        <tr style="border-bottom: 1px solid;">
            <td style="width: 33%; height: 60px; border-bottom: 1px dashed gray;"> <b>Matricola</b></td>
            <td style="width: 34%; height: 60px; border-bottom: 1px dashed gray;"> <b>Prodotto</b></td>
            <td style="width: 34%; height: 60px; border-bottom: 1px dashed gray;"> <b>Fornitore</b></td>
        </tr>
        @foreach($prodotti as $item)
            <tr style="border-bottom: 1px solid">
                <td style="width: 33%; padding: 5px; border-bottom: 1px dashed gray;">{{$item['matricola']}}</td>
                <td style="width: 34%; padding: 5px; border-bottom: 1px dashed gray;">{{$item['nome']}}</td>
                <td style="width: 34%; padding: 5px; border-bottom: 1px dashed gray;">{{$item['fornitore']}}</td>
            </tr>
        @endforeach
    </table>
</div>

