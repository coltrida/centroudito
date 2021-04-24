<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class FrontController extends Controller
{
    public function inizio()
    {
        return view('inizio');
    }
}
