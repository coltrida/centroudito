<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Medico
 *
 * @property int $id
 * @property string $nome
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\OrarioMedico[] $orari
 * @property-read int|null $orari_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $prova
 * @property-read int|null $prova_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Medico newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medico newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Medico query()
 * @method static \Illuminate\Database\Eloquent\Builder|Medico whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medico whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medico whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medico whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medico whereUserId($value)
 * @property-read int|null $user_count
 * @property string $cognome
 * @property string|null $cod
 * @property-read mixed $fullname
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $provaFinalizzata
 * @property-read int|null $prova_finalizzata_count
 * @method static \Illuminate\Database\Eloquent\Builder|Medico whereCod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Medico whereCognome($value)
 * @mixin \Eloquent
 */
class Medico extends Model
{
    use HasFactory;

    protected $table = 'medicos';
    protected $guarded = [];
    protected $appends = ['fullname'];

    public function orari()
    {
        return $this->hasMany(OrarioMedico::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function prova()
    {
        return $this->hasManyThrough(Prova::class, Client::class);
    }

    public function provaFinalizzata()
    {
        return $this->hasManyThrough(Prova::class, Client::class)
            ->where('stato_id', 4);
    }

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    public function getFullnameAttribute()
    {
        return $this->cognome.' '.$this->nome;
    }
}
