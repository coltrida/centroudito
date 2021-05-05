<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class UserController extends Controller
{
    public function audioprotesisti()
    {
        return view('personale.audioprotesisti');
    }

    public function amministrazione()
    {
        return view('personale.amministrazione');
    }

    public function associaFiliale()
    {
        return view('gestione.userFiliale');
    }

    public function budget()
    {
        return view('gestione.assegnaBudget');
    }
}
