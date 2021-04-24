<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.index');
    }
}
