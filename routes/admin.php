<?php

use App\Http\Controllers\Admin\BudgetController;
use App\Http\Controllers\Admin\CanaliController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\FilialeController;
use App\Http\Controllers\Admin\FornitoreController;
use App\Http\Controllers\Admin\ListinoController;
use App\Http\Controllers\Admin\PersonaleController;
use App\Http\Controllers\Admin\RecapitoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::middleware('auth')->group(callback: function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    //------------- FILIALI ------------------//
    Route::get('/admin/filiali', [FilialeController::class, 'filiali'])->name('admin.filiali');
    Route::get('/admin/filiali/aggiungi', [FilialeController::class, 'aggiungiFiliale'])->name('admin.filiali.aggiungi');
    Route::post('/admin/filiali/aggiungi', [FilialeController::class, 'salvaFiliale'])->name('admin.filiali.salva');
    Route::get('/admin/filiali/elimina/{id}', [FilialeController::class, 'eliminaFiliale'])->name('admin.filiali.elimina');
    Route::get('/admin/filiali/audio/{id}', [FilialeController::class, 'listaFilialiAudio'])->name('admin.filiali.audio');
    Route::get('/admin/filiali/associaAudio', [FilialeController::class, 'associaFilialeAudio'])->name('admin.filiali.associaAudio');
    Route::post('/admin/filiali/associaAudio', [FilialeController::class, 'eseguiAssociaFilialeAudio'])->name('admin.filiali.eseguiAssociaAudio');
    Route::get('/admin/filiali/eliminaAssociazione/{id}', [FilialeController::class, 'eliminaAssociazione'])->name('admin.filiali.eliminaAssociazione');

    //------------- RECAPITI ------------------//
    Route::get('/admin/recapiti', [RecapitoController::class, 'recapiti'])->name('admin.recapiti');
    Route::get('/admin/recapiti/aggiungi', [RecapitoController::class, 'aggiungiRecapito'])->name('admin.recapiti.aggiungi');
    Route::post('/admin/recapiti/aggiungi', [RecapitoController::class, 'salvaRecapito'])->name('admin.recapiti.salva');
    Route::get('/admin/recapiti/elimina/{id}', [RecapitoController::class, 'eliminaRecapito'])->name('admin.recapiti.elimina');

    //------------- PERSONALE ------------------//
    Route::get('/admin/personale', [PersonaleController::class, 'personale'])->name('admin.personale');
    Route::get('/admin/personale/aggiungi', [PersonaleController::class, 'aggiungiPersonale'])->name('admin.personale.aggiungi');
    Route::post('/admin/personale/aggiungi', [PersonaleController::class, 'salvaPersonale'])->name('admin.personale.salva');
    Route::get('/admin/personale/elimina/{id}', [PersonaleController::class, 'eliminaPersonale'])->name('admin.personale.elimina');

    //------------- FORNITORI ------------------//
    Route::get('/admin/fornitori', [FornitoreController::class, 'fornitori'])->name('admin.fornitori');
    Route::get('/admin/fornitori/aggiungi', [FornitoreController::class, 'aggiungiFornitore'])->name('admin.fornitore.aggiungi');
    Route::post('/admin/fornitori/aggiungi', [FornitoreController::class, 'salvaFornitore'])->name('admin.fornitore.salva');
    Route::get('/admin/fornitori/elimina/{id}', [FornitoreController::class, 'eliminaFornitore'])->name('admin.fornitore.elimina');

    //------------- CATEGORIE ------------------//
    Route::get('/admin/categorie', [CategoriaController::class, 'categorie'])->name('admin.categorie');
    Route::post('/admin/categorie/aggiungi', [CategoriaController::class, 'salvaCategoria'])->name('admin.categoria.salva');
    Route::get('/admin/categorie/elimina/{id}', [CategoriaController::class, 'eliminaCategoria'])->name('admin.categoria.elimina');

    //------------- LISTINO ------------------//
    Route::get('/admin/listino', [ListinoController::class, 'listino'])->name('admin.listino');
    Route::get('/admin/listino/aggiungi', [ListinoController::class, 'aggiungiListino'])->name('admin.listino.aggiungi');
    Route::post('/admin/listino/aggiungi', [ListinoController::class, 'salvaListino'])->name('admin.listino.salva');
    Route::get('/admin/listino/elimina/{id}', [ListinoController::class, 'eliminaListino'])->name('admin.listino.elimina');

    //------------- MARKETING ------------------//
    Route::get('/admin/marketing', [CanaliController::class, 'marketing'])->name('admin.marketing');
    Route::post('/admin/marketing/aggiungi', [CanaliController::class, 'salvaMarketing'])->name('admin.marketing.salva');
    Route::get('/admin/marketing/elimina/{id}', [CanaliController::class, 'eliminaMarketing'])->name('admin.marketing.elimina');

    //------------- BUDGET ------------------//
    Route::get('/admin/budget', [BudgetController::class, 'budget'])->name('admin.budget');
    Route::post('/admin/budget/sceltaAnno', [BudgetController::class, 'sceltaAnno'])->name('admin.budget.sceltaAnno');
    Route::post('/admin/budget/salva', [BudgetController::class, 'salvaBudget'])->name('admin.budget.salva');
    Route::get('/admin/budget/elimina/{id}', [BudgetController::class, 'eliminaBudget'])->name('admin.budget.elimina');
});
