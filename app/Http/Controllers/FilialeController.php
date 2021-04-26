<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class FilialeController extends Controller
{
    public function index()
    {
        return view('filiale.index');
    }
}
