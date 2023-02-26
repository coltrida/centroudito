<?php


use App\Http\Controllers\AppuntamentoController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProvaController;
use App\Http\Controllers\VecchioController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //------------- CLIENTI ------------------//
    Route::get('/clients/{idFiliale}', [ClientController::class, 'clientsFiliale'])->name('clients');
    Route::get('/client/aggiungiModifica/{idFiliale}/{idClient?}', [ClientController::class, 'aggiungiModificaClient'])->name('client.aggiungiModifica');
    Route::post('/client/aggiungi', [ClientController::class, 'salvaClient'])->name('client.salva');
    Route::post('/client/ricerca', [ClientController::class, 'ricercaClient'])->name('client.ricerca');
    Route::patch('/client/modifica', [ClientController::class, 'modificaClient'])->name('client.modifica');
    Route::delete('/client/elimina', [ClientController::class, 'eliminaClient'])->name('client.elimina');

    //------------- APPUNTAMENTI ------------------//
    Route::get('/appuntamenti/{idClient}', [AppuntamentoController::class, 'appuntamentiClient'])->name('appuntamenti');
    Route::post('/appuntamento/aggiungi', [AppuntamentoController::class, 'aggiungiAppuntamento'])->name('appuntamento.aggiungi');
    Route::delete('/appuntamento/elimina', [AppuntamentoController::class, 'eliminaAppuntamento'])->name('appuntamento.elimina');

    //------------- PROVE ------------------//
    Route::get('/prova/{idClient}', [ProvaController::class, 'prova'])->name('prova');


});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
