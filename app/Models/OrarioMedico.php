<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\OrarioMedico
 *
 * @property int $id
 * @property int $medico_id
 * @property string $dove
 * @property string $giorno
 * @property string $orario
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrarioMedico newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrarioMedico newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrarioMedico query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrarioMedico whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrarioMedico whereDove($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrarioMedico whereGiorno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrarioMedico whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrarioMedico whereMedicoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrarioMedico whereOrario($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrarioMedico whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class OrarioMedico extends Model
{
    use HasFactory;

    protected $table = 'orario_medicos';
    protected $guarded = [];
}
