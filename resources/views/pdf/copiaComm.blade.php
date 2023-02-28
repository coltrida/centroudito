<div style="border-bottom: 1px solid black; height: 180px; width: 100%">
    <div style="font-size: 14px">
        <img src="{{asset('img/logo-centroudito.jpg')}}" style="width: 200px">
    </div>
    <div style="float: left">
        <br><br>
        <div>Audioprotesista: {{$provaSalvata->user->name}}</div>
    </div>
    <div style="float: right; font-size: 14px">
        <div>Copia Commissione nr.{{$provaSalvata->progressivo}} del {{$provaSalvata->created_at->format('d-m-Y')}}</div>
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
        <div style="margin-bottom: 5px"> <b>{{$provaSalvata->client->nome.' '.$provaSalvata->client->cognome}}</b> </div>
        <div>Nato a: {{$provaSalvata->client->luogoNascita}}</div>
        <div>Il: {{Carbon\Carbon::make($provaSalvata->client->datanascita)->format('d-m-Y')}}</div>
        <div>Indirizzo: {{$provaSalvata->client->indirizzo}}</div>
        <div>Città: {{$provaSalvata->client->citta}}</div>
        <div>CAP: {{$provaSalvata->client->cap}}</div>
    </div>
    <div style="float: right; width: 40%; padding: 10px; font-size: 14px">
        <div style="margin-bottom: 5px">&nbsp;</div>
        <div>Prov: {{$provaSalvata->client->provincia}}</div>
        <div>Tel: {{$provaSalvata->client->telefono}}</div>
        <div>Cellulare: {{$provaSalvata->client->telefono2}}</div>
        <div>Cod. Fiscale: {{$provaSalvata->client->codfisc}}</div>
        <div>Mail: {{$provaSalvata->client->mail}}</div>
    </div>
    {{--Il/la sottoscritto/a{{str_pad($provaSalvata->client->nome.' '.$provaSalvata->client->cognome, 32, " ", STR_PAD_BOTH)}}
    nato/a{{str_pad($provaSalvata->client->luogoNascita, 30, " ", STR_PAD_BOTH)}}<br><br>
    il{{str_pad($provaSalvata->client->datanascita, 18, " ", STR_PAD_BOTH)}}
    indirizzo{{str_pad($provaSalvata->client->indirizzo, 40, " ", STR_PAD_BOTH)}}
    CAP{{str_pad($provaSalvata->client->cap, 12, " ", STR_PAD_BOTH)}}<br><br>
    Città{{str_pad($provaSalvata->client->citta, 30, " ", STR_PAD_BOTH)}}
    Prov{{str_pad($provaSalvata->client->provincia, 4, " ", STR_PAD_BOTH)}}
    Tel{{str_pad($provaSalvata->client->telefono, 14, " ", STR_PAD_BOTH)}}
    Cellulare{{str_pad($provaSalvata->client->telefono2, 14, " ", STR_PAD_BOTH)}}<br><br>
    Cod. Fiscale{{str_pad($provaSalvata->client->codfisc, 34, " ", STR_PAD_BOTH)}}
    Mail{{str_pad($provaSalvata->client->mail, 36, " ", STR_PAD_BOTH)}}<br>--}}
</div>

<div style="border: 1px solid black;  width: 100%; background-color: #eeeeee; padding: 10px">
    <table style="width: 100%; margin-bottom: 40px">
        <tr style="border-bottom: 1px solid;">
            <td style="width: 33%; height: 60px; border-bottom: 1px dashed gray;"> <b>Matricola</b></td>
            <td style="width: 34%; height: 60px; border-bottom: 1px dashed gray;"> <b>Prodotto</b></td>
            <td style="width: 33%; height: 60px; border-bottom: 1px dashed gray;"> <b>Prezzo</b></td>
        </tr>
        @foreach($provaSalvata->product as $product)
            <tr style="border-bottom: 1px solid">
                <td style="width: 33%; padding: 5px; border-bottom: 1px dashed gray;">{{$product->matricola}}</td>
                <td style="width: 34%; padding: 5px; border-bottom: 1px dashed gray;">{{$product->listino->nome}}</td>
                <td style="width: 33%; padding: 5px; border-bottom: 1px dashed gray;">{{$product->pivot->prezzo_formattato}}</td>
            </tr>
        @endforeach
    </table>

    <div style="display:flex;">
        <div style="margin-left: 5px"><b>Totale:</b> </div>
        <div style="float: right; margin-right: 170px">
            <b>{{$provaSalvata->tot_formattato}}</b>
        </div>
    </div>

</div>

<div style="border: 1px solid black;
        font-size: 8px;
        height: 300px;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 30px;
        padding: 10px">
    <h3>Altre condizioni del Contratto</h3>
    <p style="text-align: justify; text-justify: inter-word;">
        1) Le merci sopra indicate ed i relativi accessori sono venduti con riserva della proprietà a favore della
        venditrice CENTRO UDITO GROUP s.r.l. e quindi il compratore ne acquisterà la proprietà soltanto al pagamento
        dell'ultima rata del prezzo concordato, ma ne assume i rischi dal momento della consegna (art. 1523 c.c.).
        Il compratore fino al passaggio della proprietà della merce non può alienare o comunque disporre di essa senza
        il consenso del venditore. In caso di violazione della clausola sopra riportata, il compratore decadrà del
        beneficio del termine rateale e dovrà versare immediatamente il residuo a saldo del prezzo concordato.
        Nell'ipotesi in cui la merce non venga consegnata, contestualmente all'ordine, ma debba essere personalizzata
        in relazione alle peculiari necessità del compratore, la stessa verrà consegnata nella data che sarà indicata
        dalla venditrice a mezzo di comunicazione scritta. Il compratore dovrà ritirare la merce entro 45 giorni da tale
        data. Il mancato ritiro nel termine suddetto, fermo restando l'obbligo del pagamento, farà decadere il
        compratore da eventuali facilitazioni concesse, facoltizzando la venditrice a richiedere l'importo totale
        pattuito. La venditrice, inoltre, esplicherà a spese del compratore, quelle azioni di legge che, per la tutela
        dei suoi diritti, si rendessero eventualmente necessarie.<br>
        2) E' in facoltà della venditrice di richiedere il rilascio di cambiali o di emettere tratte sul compratore, che
        si obbliga a rilasciare le cambiali ed autorizza le tratte si d'ora, senza che ciò possa costituire in alcun
        caso novazione delle obbligazioni di cui al presente contratto.<br>
        3) Le rate del prezzo andranno corrisposte presso la sede o filiale dove è stato concluso il contratto, oppure,
        a mani di agenti della venditrice. La eventuale accettazione, da parte della venditrice, di tratte o altri effetti
        di commercio, si intenderà sempre avventuta con la clausola "salvo buon fine". Il mancato pagamento di una rata
        di importo superiore all'ottava parte del prezzo, farà decadere il compratore dal beneficio del termine e darà
        diritto alla venditrice di richiedere subito il saldo del prezzo, oppure di ritenere senz'altro risolto il
        contratto con restituzione immediata della merce ed acquisizione a titolo di indennizzo della rata pagata, salvo
        comunque, il risarcimento dei danni.<br>
        <b>4) Al compratore non è consentito recedere dal contratto.</b> <br>
        Qualora il contratto sia stato negoziato fuori dei locali commerciali della venditrice, il compratore, in caso
        di ripensamento, ha la facoltà di revocare la proposta d'ordine mediante lettera raccomandata con ricevuta di
        ritorno da spedirsi alla sede legale della venditrice. La revoca deve essere spedita entro e non oltre il settimo
        giorno successivo alla data di sottoscrizione della proposta. In tal caso la proposta si intenderà annullata e
        saranno restituiti al compratore gli eventuali anticipi che siano stati da esso versati esclusa qualsiasi
        indennità o penalità a suo carico. In caso di tempestivo esercizio della facoltà di ripensamento il compratore
        che abbia eventulamente ricevuto la merce, deve restituire la stessa, astenendosi dal farne uso e dall'arrecarne
        qualsiasi danno entro sette giorni dalla consegna. Tale restituzione va effettuata a cura e spese del compratore
        mediante spedizione alla sede legale della venditrice. <br>
        5) Qualora il pagamento del prezzo sia convenuto in tutto o in parte alla consegna della merce, il compratore
        è obbligato al pagamento del prezzo quando ha notiza che la merce è disponibile per il ritiro. Il mancato ritiro
        nei quindici giorni successivi alla data di costituzione di mora del compratore, determinerà la facoltà per la
        venditrice di agire per l'adempimento con conseguente diritto di ottenere il saldo oltre gli interessi frattanto
        maturati. <br>
        6) In caso di ritardo di pagamenti resta convenuto che la venditrice ha diritto di addebitare gli interessi moratori
        nella misura dei tassi correnti bancari sull'esposizione debitorie, su tutto quanto ancora dovuto.<br>
        7) La merce è garantita per ventiquattro mesi (due anni) con decorrenza dalla data della consegna per tutti i difetti
        di materiale e di fabbricazione a condizione che si verifichino durante il normale utilizzo. Il diritto di garanzia
        andrà esercitato entro otto giorni dalla scoperta dei vizi. Il compratore potrà esercitare il diritto di garanzia
        consegnando direttamente l'apparecchio difettoso presso la sede o una filiale della venditrice. La venditrice si
        riserva il diritto di stabilire se i componenti difettosi debbano essere riparati o sostituiti. Sono esclusi dalla
        garanzia i guasti derivanti dall'uso inappropriato (in via esemplificativa urti, cadute o manomissioni) da parte del
        compratore. La garanzia decade se gli apparecchi sono stati manomessi da terzi non autorizzati, come pure se sono
        stati utilizzati accessori e parti di ricambio non originali. La garanzia non produrrà effetto ove il compratore
        non sia in regola con i pagamenti, che dovranno proseguire regolarmente anche caso in cui la garanzia diventi
        operante. <br>
        8) Patti aggiunti o contrari al presente modulo contrattuale non avranno alcun valore se non saranno approvati
        e confermati per iscritto dai legali rappresentanti di CENTRO UDITO GROUP S.R.L.
    </p>
</div>

<div style="display:flex;">
    <div style="font-size: 14px">
        <div style="margin-left: 5px">Data: {{$provaSalvata->created_at->format('d-m-Y')}}</div>
    </div>
    <div style="float: right; font-size: 14px; margin-right: 40px">
        <div>Firma</div>
    </div>
</div>

