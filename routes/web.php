<?php


use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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
    Route::get('/clients/{idFiliale}', [HomeController::class, 'clientsFiliale'])->name('clients');
    Route::get('/client/aggiungiModifica/{idFiliale}/{idClient?}', [HomeController::class, 'aggiungiModificaClient'])->name('client.aggiungiModifica');
    Route::post('/client/aggiungi', [HomeController::class, 'salvaClient'])->name('client.salva');
    Route::post('/client/ricerca', [HomeController::class, 'ricercaClient'])->name('client.ricerca');
    Route::patch('/client/modifica', [HomeController::class, 'modificaClient'])->name('client.modifica');
    Route::delete('/client/elimina', [HomeController::class, 'eliminaClient'])->name('client.elimina');

    //------------- APPUNTAMENTI ------------------//
    Route::get('/appuntamenti/{idClient}', [HomeController::class, 'appuntamentiClient'])->name('appuntamenti');
    Route::post('/appuntamento/aggiungi', [HomeController::class, 'aggiungiAppuntamento'])->name('appuntamento.aggiungi');
    Route::delete('/appuntamento/elimina', [HomeController::class, 'eliminaAppuntamento'])->name('appuntamento.elimina');
});

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';
