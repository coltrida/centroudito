<?php

namespace App\Http\Controllers;

use App\Services\FilialeService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(FilialeService $filialeService)
    {
        $filiali = $filialeService->lista();
        return view('admin.index', compact('filiali'));
    }
}
