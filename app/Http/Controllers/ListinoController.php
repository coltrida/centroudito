<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class ListinoController extends Controller
{
    public function index()
    {
        return view('listino.index');
    }
}
