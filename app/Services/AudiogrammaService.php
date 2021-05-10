<?php


namespace App\Services;


use App\Models\Audiometria;
use App\Models\Client;
use function dd;

class AudiogrammaService
{
    public function caricaAudiometrie($id)
    {
        return Client::with(['audiometria' => function($q) {
            $q->latest();
        }])->find($id)->audiometria;
    }

    public function salva($id, $destro, $sinistro)
    {
        $nuovaAudiometria = new Audiometria();
        $nuovaAudiometria->client_id = $id;
        isset($destro[1]) ? $nuovaAudiometria->_125d = -( (int)$destro[1] * 10 ) : null ;
        isset($destro[2]) ? $nuovaAudiometria->_250d = -( (int)$destro[2] * 10 ) : null ;
        isset($destro[3]) ? $nuovaAudiometria->_500d = -( (int)$destro[3] * 10 ) : null ;
        isset($destro[4]) ? $nuovaAudiometria->_1000d = -( (int)$destro[4] * 10 ) : null ;
        isset($destro[5]) ? $nuovaAudiometria->_1500d = -( (int)$destro[5] * 10 ) : null ;
        isset($destro[6]) ? $nuovaAudiometria->_2000d = -( (int)$destro[6] * 10 ) : null ;
        isset($destro[7]) ? $nuovaAudiometria->_3000d = -( (int)$destro[7] * 10 ) : null ;
        isset($destro[8]) ? $nuovaAudiometria->_4000d = -( (int)$destro[8] * 10 ) : null ;
        isset($destro[9]) ? $nuovaAudiometria->_6000d = -( (int)$destro[9] * 10 ) : null ;
        isset($destro[10]) ? $nuovaAudiometria->_8000d = -( (int)$destro[10] * 10 ) : null ;

        isset($sinistro[1]) ? $nuovaAudiometria->_125s = -( (int)$sinistro[1] * 10 ) : null ;
        isset($sinistro[2]) ? $nuovaAudiometria->_250s = -( (int)$sinistro[2] * 10 ) : null ;
        isset($sinistro[3]) ? $nuovaAudiometria->_500s = -( (int)$sinistro[3] * 10 ) : null ;
        isset($sinistro[4]) ? $nuovaAudiometria->_1000s = -( (int)$sinistro[4] * 10 ) : null ;
        isset($sinistro[5]) ? $nuovaAudiometria->_1500s = -( (int)$sinistro[5] * 10 ) : null ;
        isset($sinistro[6]) ? $nuovaAudiometria->_2000s = -( (int)$sinistro[6] * 10 ) : null ;
        isset($sinistro[7]) ? $nuovaAudiometria->_3000s = -( (int)$sinistro[7] * 10 ) : null ;
        isset($sinistro[8]) ? $nuovaAudiometria->_4000s = -( (int)$sinistro[8] * 10 ) : null ;
        isset($sinistro[9]) ? $nuovaAudiometria->_6000s = -( (int)$sinistro[9] * 10 ) : null ;
        isset($sinistro[10]) ? $nuovaAudiometria->_8000s = -( (int)$sinistro[10] * 10 ) : null ;
        $nuovaAudiometria->save();
    }
}
