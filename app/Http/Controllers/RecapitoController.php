<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class RecapitoController extends Controller
{
    public function index()
    {
        return view('recapito.index');
    }
}
