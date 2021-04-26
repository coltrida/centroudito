<?php


namespace App\Services;


use App\Models\Marketing;

class MarketingService
{
    public function canali()
    {
        return Marketing::orderBy('name')->get();
    }

    public function inserisci($nome)
    {
        return Marketing::insert(['name' => $nome]);
    }

    public function rimuovi($id)
    {
        return Marketing::find($id)->delete();
    }
}
