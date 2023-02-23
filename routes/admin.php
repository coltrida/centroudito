<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    //------------- FILIALI ------------------//
    Route::get('/admin/filiali', [AdminController::class, 'filiali'])->name('admin.filiali');
    Route::get('/admin/filiali/aggiungi', [AdminController::class, 'aggiungiFiliale'])->name('admin.filiali.aggiungi');
    Route::post('/admin/filiali/aggiungi', [AdminController::class, 'salvaFiliale'])->name('admin.filiali.salva');
    Route::get('/admin/filiali/elimina/{id}', [AdminController::class, 'eliminaFiliale'])->name('admin.filiali.elimina');
    Route::get('/admin/filiali/audio/{id}', [AdminController::class, 'listaFilialiAudio'])->name('admin.filiali.audio');
    Route::get('/admin/filiali/associaAudio', [AdminController::class, 'associaFilialeAudio'])->name('admin.filiali.associaAudio');
    Route::post('/admin/filiali/associaAudio', [AdminController::class, 'eseguiAssociaFilialeAudio'])->name('admin.filiali.eseguiAssociaAudio');
    Route::get('/admin/filiali/eliminaAssociazione/{id}', [AdminController::class, 'eliminaAssociazione'])->name('admin.filiali.eliminaAssociazione');

    //------------- RECAPITI ------------------//
    Route::get('/admin/recapiti', [AdminController::class, 'recapiti'])->name('admin.recapiti');
    Route::get('/admin/recapiti/aggiungi', [AdminController::class, 'aggiungiRecapito'])->name('admin.recapiti.aggiungi');
    Route::post('/admin/recapiti/aggiungi', [AdminController::class, 'salvaRecapito'])->name('admin.recapiti.salva');
    Route::get('/admin/recapiti/elimina/{id}', [AdminController::class, 'eliminaRecapito'])->name('admin.recapiti.elimina');

    //------------- PERSONALE ------------------//
    Route::get('/admin/personale', [AdminController::class, 'personale'])->name('admin.personale');
    Route::get('/admin/personale/aggiungi', [AdminController::class, 'aggiungiPersonale'])->name('admin.personale.aggiungi');
    Route::post('/admin/personale/aggiungi', [AdminController::class, 'salvaPersonale'])->name('admin.personale.salva');
    Route::get('/admin/personale/elimina/{id}', [AdminController::class, 'eliminaPersonale'])->name('admin.personale.elimina');

    //------------- FORNITORI ------------------//
    Route::get('/admin/fornitori', [AdminController::class, 'fornitori'])->name('admin.fornitori');
    Route::get('/admin/fornitori/aggiungi', [AdminController::class, 'aggiungiFornitore'])->name('admin.fornitore.aggiungi');
    Route::post('/admin/fornitori/aggiungi', [AdminController::class, 'salvaFornitore'])->name('admin.fornitore.salva');
    Route::get('/admin/fornitori/elimina/{id}', [AdminController::class, 'eliminaFornitore'])->name('admin.fornitore.elimina');

    //------------- CATEGORIE ------------------//
    Route::get('/admin/categorie', [AdminController::class, 'categorie'])->name('admin.categorie');
    Route::post('/admin/categorie/aggiungi', [AdminController::class, 'salvaCategoria'])->name('admin.categoria.salva');
    Route::get('/admin/categorie/elimina/{id}', [AdminController::class, 'eliminaCategoria'])->name('admin.categoria.elimina');

    //------------- LISTINO ------------------//
    Route::get('/admin/listino', [AdminController::class, 'listino'])->name('admin.listino');
    Route::get('/admin/listino/aggiungi', [AdminController::class, 'aggiungiListino'])->name('admin.listino.aggiungi');
    Route::post('/admin/listino/aggiungi', [AdminController::class, 'salvaListino'])->name('admin.listino.salva');
    Route::get('/admin/listino/elimina/{id}', [AdminController::class, 'eliminaListino'])->name('admin.listino.elimina');

    //------------- MARKETING ------------------//
    Route::get('/admin/marketing', [AdminController::class, 'marketing'])->name('admin.marketing');
    Route::post('/admin/marketing/aggiungi', [AdminController::class, 'salvaMarketing'])->name('admin.marketing.salva');
    Route::get('/admin/marketing/elimina/{id}', [AdminController::class, 'eliminaMarketing'])->name('admin.marketing.elimina');

    //------------- BUDGET ------------------//
    Route::get('/admin/budget', [AdminController::class, 'budget'])->name('admin.budget');
    Route::post('/admin/budget/sceltaAnno', [AdminController::class, 'sceltaAnno'])->name('admin.budget.sceltaAnno');
    Route::post('/admin/budget/salva', [AdminController::class, 'salvaBudget'])->name('admin.budget.salva');
    Route::get('/admin/budget/elimina/{id}', [AdminController::class, 'eliminaBudget'])->name('admin.budget.elimina');
});
