<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Illuminate\Support\Str;
use Livewire\Component;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class ClientDatatables extends LivewireDatatable
{
    public $idAudio;
  //  public $perPage = 5;
  //  public $model =  Client::class;

    public function builder()
    {
        return $this->idAudio != '' ? Client::query()->where('user_id', $this->idAudio) : Client::query();
    }

    public function columns()
    {
        return [
            /*Column::delete(),*/

            Column::name('id')->view2('components.button2')->label(''),

            Column::name('name')
                ->label('Nome'),

            Column::name('indirizzo'),
            Column::name('citta'),
            Column::name('provincia'),
            Column::name('cap'),
            Column::name('telefono'),
            Column::name('tipo'),
            Column::name('fonte'),
            Column::name('codfisc'),

            DateColumn::name('created_at')
                ->sortBy('created_at')
                ->defaultSort('asc')
                ->label('Data Creazione')
        ];
    }
}
