<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FilialeController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MarketingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'inizio'])->name('inizio');

require __DIR__.'/auth.php';

Route::group([ 'middleware' => 'auth' ], function() {
    Route::get('/clients/inserisci', [ClientController::class, 'inserisci'])->name('client.inserisci');
    Route::post('/clients/inserisci', [ClientController::class, 'postInserisci'])->name('client.postInserisci');
    Route::get('/clients/{idAudio?}', [ClientController::class, 'index'])->name('client.index');
});

Route::group(['middleware' => ['auth','verifyIsAdmin'], 'prefix' => 'admin'], function(){
    Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.idex');
    Route::get('/filiali', [FilialeController::class, 'index'])->name('filiale.idex');
});

