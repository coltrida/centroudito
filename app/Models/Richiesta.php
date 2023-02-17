<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Richiesta
 *
 * @property int $id
 * @property int $filiale_id
 * @property int $listino_id
 * @property int $quantita
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Filiale $filiale
 * @property-read \App\Models\Listino $listino
 * @method static \Illuminate\Database\Eloquent\Builder|Richiesta newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Richiesta newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Richiesta query()
 * @method static \Illuminate\Database\Eloquent\Builder|Richiesta whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Richiesta whereFilialeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Richiesta whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Richiesta whereListinoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Richiesta whereQuantita($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Richiesta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Richiesta extends Model
{
    use HasFactory;
    protected $table = 'richiestas';
    protected $guarded = [];

    public function filiale()
    {
        return $this->belongsTo(Filiale::class);
    }

    public function listino()
    {
        return $this->belongsTo(Listino::class);
    }
}
