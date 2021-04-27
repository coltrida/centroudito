<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class UserController extends Controller
{
    public function audioprotesisti()
    {
        return view('audioprotesisti.index');
    }
}
