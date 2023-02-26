<?php

namespace App\Http\Controllers;

class ProvaController extends Controller
{
    public function prova($idClient)
    {
        return view('prove.index', compact('idClient'));
    }

}
