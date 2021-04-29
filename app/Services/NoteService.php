<?php


namespace App\Services;


use App\Models\Client;
use App\Models\Note;
use Carbon\Carbon;
use Illuminate\Support\Str;
use function trim;

class NoteService
{
    public function note($id)
    {
            return Client::find($id)->notes;
    }

    public function inserisci($testo, $client_id)
    {
        return Note::insert([
            'testo' => trim(Str::upper($testo)),
            'client_id' => $client_id,
            'created_at' => Carbon::now()
        ]);
    }

    public function rimuovi($id)
    {
        return Note::find($id)->delete();
    }
}
