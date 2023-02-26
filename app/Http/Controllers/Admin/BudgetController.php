<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function budget(UserService $userService)
    {
        return view('admin.budget.index');
    }

    public function sceltaAnno(Request $request, UserService $userService)
    {
        $audioSenzaBgt = $userService->audioSenzaBgt($request);
        $audioConBgt = $userService->audioConBgt($request);
        $anno = $request->anno;
        return view('admin.budget.index', compact('audioSenzaBgt', 'audioConBgt', 'anno'));
    }

    public function salvaBudget(Request $request, UserService $userService)
    {
        $userService->assegnaBgt($request);
        $audioSenzaBgt = $userService->audioSenzaBgt($request);
        $audioConBgt = $userService->audioConBgt($request);
        $anno = $request->anno;
        return view('admin.budget.index', compact('audioSenzaBgt', 'audioConBgt', 'anno'));
    }

    public function eliminaBudget($id, UserService $userService)
    {
        $userService->eliminaBgt($id);

        return \Redirect::route('admin.budget')->with('message','Budget Eliminato');
    }
}
