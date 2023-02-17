<?php

namespace App\Http\Controllers;

use App\Services\FilialeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function filiali(FilialeService $filialeService)
    {
        $filiali = $filialeService->lista();
        return view('admin.filiali', compact('filiali'));
    }

    public function personale(UserService $userService)
    {
        $users = $userService->lista();
        return view('admin.personale', compact('users'));
    }
}
