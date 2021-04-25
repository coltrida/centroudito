<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'inizio'])->name('inizio');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');*/

require __DIR__.'/auth.php';

Route::group([ 'middleware' => 'auth' ], function() {
    Route::get('/clients/{idAudio}', [ClientController::class, 'index'])->name('client.index');
    });

Route::group(['middleware' => ['auth','verifyIsAdmin'], 'prefix' => 'admin'], function(){
    Route::get('/clients', [ClientController::class, 'indexAdmin'])->name('admin.client.index');
    });

