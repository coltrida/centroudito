<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Strumentazione
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione query()
 * @property int $id
 * @property string $nome
 * @property string $matricola
 * @property string $fornitore
 * @property string|null $user_id
 * @property string|null $medico_id
 * @property int|null $filiale_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Filiale|null $filiale
 * @property-read \App\Models\Medico|null $medico
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione whereFilialeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione whereFornitore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione whereMatricola($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione whereMedicoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Strumentazione whereUserId($value)
 * @mixin \Eloquent
 */
class Strumentazione extends Model
{
    use HasFactory;

    protected $table = 'strumentaziones';
    protected $guarded = [];

    public function filiale()
    {
        return $this->belongsTo(Filiale::class);
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
