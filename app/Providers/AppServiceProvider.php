<?php

namespace App\Providers;

use App\Models\Filiale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use function dd;

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
    public function boot()
    {
        view()->composer('*', function ($view)
        {
            $filiali = Filiale::orderBy('nome')->get();
            $view->with('filiali', $filiali );
            if (isset(Auth::user()->name)){
                $filialiAudio = User::find(Auth::id())->filiale()->get();
                $view->with('filialiAudio', $filialiAudio );
            }
        });
    }
}
