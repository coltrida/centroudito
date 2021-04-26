<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use function view;

class MarketingController extends Controller
{
    public function index()
    {
        return view('marketing.index');
    }
}
