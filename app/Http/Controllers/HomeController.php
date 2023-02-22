<?php

namespace App\Http\Controllers;

use App\Services\FilialeService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(FilialeService $filialeService)
    {
        $filiali = [];
        if (\Auth::user()){
            $filiali = $filialeService->filialiAudio(\Auth::id());
        }
        return view('home', compact('filiali'));
    }
}
