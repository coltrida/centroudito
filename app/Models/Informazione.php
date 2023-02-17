<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Informazione
 *
 * @property int $id
 * @property int $client_id
 * @property string|null $giorno
 * @property string|null $tipo
 * @property string|null $note
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Informazione newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Informazione newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Informazione query()
 * @method static \Illuminate\Database\Eloquent\Builder|Informazione whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Informazione whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Informazione whereGiorno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Informazione whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Informazione whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Informazione whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Informazione whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Informazione extends Model
{
    use HasFactory;
    protected $table = 'informaziones';
    protected $guarded = [];

}
