<?php


namespace App\Services;


use App\Models\Marketing;
use Illuminate\Support\Str;

class MarketingService
{
    public function canali()
    {
        return Marketing::orderBy('name')->get();
    }

    public function inserisci($nome)
    {
        return Marketing::insert(['name' => trim(Str::upper($nome))]);
    }

    public function rimuovi($id)
    {
        return Marketing::find($id)->delete();
    }
}
