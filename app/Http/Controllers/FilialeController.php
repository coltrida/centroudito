<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function compact;
use function dd;
use function view;

class FilialeController extends Controller
{
    public function index()
    {
        return view('filiale.index');
    }

    public function magazzino($idFiliale)
    {
        return view('magazzino.index', compact('idFiliale'));
    }

    public function magazzinoFiliale($idFiliale)
    {
        return view('magazzino.filiale', compact('idFiliale'));
    }

}
