<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class ClientController extends Controller
{
    public function indexAdmin()
    {
        return view('client.index', ['idAudio' => '']);
    }

    public function index($idAudio)
    {
        return view('client.index', ['idAudio' => $idAudio]);
    }
}
