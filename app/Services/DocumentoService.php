<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Documento;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Storage;

class DocumentoService
{
    public function salvaDocumento($request)
    {
        if($request->hasfile('file')) {
            //dd($request->idClient);
            $mese = Carbon::now()->month;
            $anno = Carbon::now()->year;

            $file = $request->file('file');
            $filename = $request->tipo.$mese.$anno.'.pdf';
            Storage::disk('public')->putFileAs('/documenti/'.$request->idClient.'/', $file, $filename);

            return Documento::create([
                'client_id' => $request->idClient,
                'tipo' => $request->tipo,
                'link' => '/storage/documenti/'.$request->idClient.'/'.$filename,
            ]);
        }
    }

    public function salvaFileXmlFromFiliale($request)
    {
        if($request->hasfile('file')) {
            $file = $request->file('file');
            $filename = $request->nomeFile;
            $path = $request->fileName;
            Storage::disk('public')->putFileAs($path, $file, $filename);
        }
    }

    public function salvaFileAdmin($request)
    {

        if($request->hasfile('file')) {
            $file = $request->file('file');
            $filename = $request->nomeFile.'.'.$file->extension();
            $path = $request->fileName;
           // Storage::disk('log')->put('/', $filename);
            Storage::disk('log')->putFileAs('/', $file, $filename);
        }
    }

    public function caricaDocumenti($idClient)
    {
        return Client::with('documenti')->find($idClient)->documenti;
    }

    public function eliminaDocumento($idDocumento)
    {
        $documento = Documento::find($idDocumento);
        $file = Str::substr($documento->link, 8);
        //dd($file);
        Storage::disk('public')->delete($file);

        $documento->delete();
    }
}
