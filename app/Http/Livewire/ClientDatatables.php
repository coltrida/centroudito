<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ClientDatatables extends LivewireDatatable
{
    public $model = Client::class;


    public function columns()
    {
        return [
            /*NumberColumn::name('id')
                ->label('ID')
                ->sortBy('id')
                ->defaultSort('asc'),*/

            Column::name('name')
                ->label('Nome')
                ->sortBy('name')
                ->defaultSort('asc'),

            Column::name('indirizzo'),
            Column::name('citta'),
            Column::name('provincia'),
            Column::name('telefono'),

            DateColumn::name('created_at')
                ->label('Data Creazione')
        ];
    }
}
