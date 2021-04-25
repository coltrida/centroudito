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
                ->label('Nome')
                ->sortBy('name')
                ->defaultSort('asc')->editable(),

            Column::name('indirizzo')->editable(),
            Column::name('citta')->editable(),
            Column::name('provincia')->editable(),
            Column::name('telefono')->editable(),

            DateColumn::name('created_at')
                ->label('Data Creazione')
        ];
    }
}
