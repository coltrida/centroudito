<?php

namespace App\Providers;

use App\Services\FilialeService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(FilialeService $filialeService)
    {
        Paginator::useBootstrapFour();


        $filiali = [];
        //compose all the views....
        view()->composer('*', function ($view) use ($filiali, $filialeService)
        {
            if (Auth::check()) {
                if (Auth::user()->is_admin) {
                    $filiali = $filialeService->lista();
                } else {
                    $filiali = $filialeService->filialiAudio(Auth::id());
                }
            }
            $view->with('filiali', $filiali );
        });
    }
}
