<?php


namespace App\Services;


use Illuminate\Http\Request;

class BaseService
{
    public $nomeDB;

    public function __construct(Request $request)
    {
        dd($request->user());
        if ($request->user()->delta_id == 1){
            $this->nomeDB = 'sviluppo';
        } else {
            $this->nomeDB = 'mysql';
        }
    }
}
