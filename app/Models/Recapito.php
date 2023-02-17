<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recapito
 *
 * @property int $id
 * @property string $nome
 * @property string|null $indirizzo
 * @property string|null $citta
 * @property string|null $provincia
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito query()
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereCitta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereIndirizzo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereProvincia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereUserId($value)
 * @property string|null $telefono
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereTelefono($value)
 * @property string|null $codiceIdentificativo
 * @property string|null $informazioni
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereCodiceIdentificativo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereInformazioni($value)
 * @property int|null $filiale_id
 * @property-read \App\Models\Filiale|null $filiale
 * @method static \Illuminate\Database\Eloquent\Builder|Recapito whereFilialeId($value)
 * @mixin \Eloquent
 */
class Recapito extends Model
{
    use HasFactory;

    protected $table = 'recapitos';
    protected $guarded = [];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function filiale()
    {
        return $this->belongsTo(Filiale::class);
    }

}
