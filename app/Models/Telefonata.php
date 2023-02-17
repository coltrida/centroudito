<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Telefonata
 *
 * @property int $id
 * @property int $user_id
 * @property int $client_id
 * @property string|null $esito
 * @property string|null $note
 * @property int $effettuata
 * @property string $datarecall
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property-read \App\Models\Client $client
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata query()
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereDatarecall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereEffettuata($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereEsito($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereUserId($value)
 * @property int $eseguita_id
 * @property int|null $mese
 * @property int|null $anno
 * @property-read \App\Models\User $audio
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereAnno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereEseguitaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Telefonata whereMese($value)
 * @mixin \Eloquent
 */
class Telefonata extends Model
{
    use HasFactory;

    protected $table = 'telefonatas';
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'eseguita_id', 'id');
    }

    public function audio()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
