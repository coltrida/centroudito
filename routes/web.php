<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FilialeController;
use App\Http\Controllers\FornitoreController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ListinoController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'inizio'])->name('inizio');

require __DIR__.'/auth.php';

Route::group([ 'middleware' => 'auth' ], function() {
    Route::get('/clients/inserisci', [ClientController::class, 'inserisci'])->name('client.inserisci');
    Route::post('/clients/recall', [ClientController::class, 'recall'])->name('client.recall');
    Route::post('/clients/inserisci', [ClientController::class, 'postInserisci'])->name('client.postInserisci');
    Route::get('/clients/{idAudio?}', [ClientController::class, 'index'])->where('idAudio', '[1-9]+')->name('client.index');
});

Route::group(['middleware' => ['auth','verifyIsAdmin'], 'prefix' => 'admin'], function(){
    Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
    Route::get('/filiali', [FilialeController::class, 'index'])->name('filiale.index');
    Route::get('/fornitori', [FornitoreController::class, 'index'])->name('fornitori.index');
    Route::get('/listino', [ListinoController::class, 'index'])->name('listino.index');
    Route::get('/personale', [UserController::class, 'audioprotesisti'])->name('personale.index');
    Route::get('/amministrazione', [UserController::class, 'amministrazione'])->name('amministrazione.index');
});

