<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FilialeController;
use App\Http\Controllers\FornitoreController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ListinoController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\RecapitoController;
use App\Http\Controllers\UserController;
use Asantibanez\LivewireCharts\Models\AreaChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\LineChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'inizio'])->name('inizio');

Route::get('/prova', function (){
    /*$pieChartModel =
        (new PieChartModel())
            ->setTitle('Expenses by Type')
            ->addSlice('prova', 4.3, '#fc8181')
            ->addSlice('prova2', 5.3, '#fc8ff')
    ;*/
    /*return view('prova', [
        'pieChartModel' => $pieChartModel
    ]);*/

    /*$areaChartModel =
        (new AreaChartModel())
            ->setTitle('Expenses by Type')
            ->addPoint('prova1', 3)
            ->addPoint('prova1', 4)
            ->addPoint('prova1', 5)
    ;*/

    $lineChartModel =
        (new LineChartModel())
            ->setTitle('Expenses by Type')
            ->addPoint('Food', 100, '#f6ad55')
            ->addPoint('Shopping', 200, '#fc8181')
        ->singleLine()
    ;
    /*return view('prova', [
        'lineChartModel' => $lineChartModel
    ]);*/

    $columnChartModel =
        (new ColumnChartModel())
            ->setTitle('Expenses by Type')
            ->addColumn('Food', 5, '#f6ad55')
            ->addColumn('Shopping', 4, '#fc8181')
            ->addColumn('Travel', 3, '#90cdf4')
    ;
    return view('prova', [
        'columnChartModel' => $columnChartModel,
        'lineChartModel' => $lineChartModel,
    ]);
});

require __DIR__.'/auth.php';

Route::group([ 'middleware' => 'auth' ], function() {
    Route::get('/clients/inserisci/{id?}', [ClientController::class, 'inserisci'])->name('client.inserisci');
    Route::post('/clients/recall', [ClientController::class, 'recall'])->name('client.recall');
    Route::post('/clients/inserisci', [ClientController::class, 'postInserisci'])->name('client.postInserisci');
    Route::patch('/clients/modifica', [ClientController::class, 'modifica'])->name('client.modifica');
    Route::get('/clients/{idAudio?}/{idFiliale?}', [ClientController::class, 'index'])->where('idAudio', '[1-9]+')->name('client.index');
    Route::get('/magazzino/{idFiliale}', [FilialeController::class, 'magazzino'])->where('id', '[1-9]+')->name('magazzino.index');
});

Route::group(['middleware' => ['auth','verifyIsAdmin'], 'prefix' => 'admin'], function(){
    Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
    Route::get('/filiali', [FilialeController::class, 'index'])->name('filiale.index');
    Route::get('/recapiti', [RecapitoController::class, 'index'])->name('recapiti.index');
    Route::get('/fornitori', [FornitoreController::class, 'index'])->name('fornitori.index');
    Route::get('/listino', [ListinoController::class, 'index'])->name('listino.index');
    Route::get('/personale', [UserController::class, 'audioprotesisti'])->name('personale.index');
    Route::get('/amministrazione', [UserController::class, 'amministrazione'])->name('amministrazione.index');
    Route::get('/user/filiale/associa', [UserController::class, 'associaFiliale'])->name('user.associaFiliale');
});

