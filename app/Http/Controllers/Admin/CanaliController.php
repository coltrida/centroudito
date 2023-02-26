<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\MarketingService;
use Illuminate\Http\Request;

class CanaliController extends Controller
{
    public function marketing(MarketingService $marketingService)
    {
        $canali = $marketingService->canali();
        return view('admin.marketing.index', compact('canali'));
    }

    public function salvaMarketing(Request $request, MarketingService $marketingService)
    {
        $marketingService->addCanale($request);
        return \Redirect::route('admin.marketing');
    }

    public function eliminaMarketing($id, MarketingService $marketingService)
    {
        $marketingService->eliminaCanale($id);

        return back()->with('message','Canale Eliminato');
    }
}
