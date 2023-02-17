<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Marketing
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Client[] $clients
 * @property-read int|null $clients_count
 * @method static \Illuminate\Database\Eloquent\Builder|Marketing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marketing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Marketing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Marketing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marketing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marketing whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Marketing whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Prova[] $provaFattura
 * @property-read int|null $prova_fattura_count
 * @property string|null $cod
 * @method static \Illuminate\Database\Eloquent\Builder|Marketing whereCod($value)
 * @mixin \Eloquent
 */
class Marketing extends Model
{
    use HasFactory;

    protected $table = 'marketings';
    protected $guarded = [];

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function provaFattura()
    {
        return $this->hasMany(Prova::class)->whereHas('stato', function ($p){
            $p->where('nome', 'FATTURA');
        });
    }
}
