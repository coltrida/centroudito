<?php

namespace App\Http\Livewire;

use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Support\Str;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use function view;

class ClientDatatables extends LivewireDatatable
{
    public $idAudio;
    public $model = Client::class;

    public function builder()
    {
        return $this->idAudio != '' ? Client::query()->where('user_id', $this->idAudio) : Client::query();
    }

//    public function columns()
//    {
//        return [
//            /*Column::delete(),*/
//
//            Column::name('id')->view2('components.button2')->label(''),
//
//            Column::name('name')
//                ->label('Nome'),
//
//            Column::name('indirizzo'),
//            Column::name('citta'),
//            Column::name('provincia'),
//            Column::name('cap'),
//            Column::name('telefono'),
//            Column::name('tipo'),
//            Column::name('fonte'),
//            Column::name('codfisc'),
//
//            DateColumn::name('created_at')
//                ->sortBy('created_at')
//                ->defaultSort('asc')
//                ->label('Data Creazione')
//        ];
//    }

    public function columns()
    {
        return [
            Column::callback(['id', 'name'], function ($id, $name) {
                return view('components.button3', ['id' => $id, 'name' => $name]);
            }),
            /*NumberColumn::name('id')->filterable(),*/
            Column::name('name')->filterable()->searchable(),
            Column::name('indirizzo')->filterable()->searchable(),
            Column::name('citta')->filterable()->searchable(),
            Column::name('cap')->filterable()->searchable(),
            Column::name('provincia')->filterable()->searchable(),
            Column::name('telefono')->filterable()->searchable(),
            Column::name('user.name')->filterable()->searchable()->label('Audioprotesista'),
            Column::name('filiale.nome')->filterable()->searchable()->label('Filile'),
            Column::name('recapito.nome')->filterable()->searchable()->label('Recapito'),
            Column::name('tipo')->filterable()->searchable(),
            Column::name('fonte')->filterable()->searchable(),
            Column::name('mail')->filterable()->searchable(),

            DateColumn::name('created_at')->filterable(),
            Column::delete()

        ];
    }
}
