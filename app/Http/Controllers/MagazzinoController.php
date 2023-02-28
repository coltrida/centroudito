<?php

namespace App\Http\Controllers;

class MagazzinoController extends Controller
{
    public function magazzino($idFiliale)
    {
        return view('magazzino.index', compact('idFiliale'));
    }
}
