<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Audiometria
 *
 * @property int $id
 * @property int $client_id
 * @property string|null $_125d
 * @property string|null $_250d
 * @property string|null $_500d
 * @property string|null $_1000d
 * @property string|null $_1500d
 * @property string|null $_2000d
 * @property string|null $_3000d
 * @property string|null $_4000d
 * @property string|null $_6000d
 * @property string|null $_8000d
 * @property string|null $_125s
 * @property string|null $_250s
 * @property string|null $_500s
 * @property string|null $_1000s
 * @property string|null $_1500s
 * @property string|null $_2000s
 * @property string|null $_3000s
 * @property string|null $_4000s
 * @property string|null $_6000s
 * @property string|null $_8000s
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client $client
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria query()
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where1000d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where1000s($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where125d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where125s($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where1500d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where1500s($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where2000d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where2000s($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where250d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where250s($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where3000d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where3000s($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where4000d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where4000s($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where500d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where500s($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where6000d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where6000s($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where8000d($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where8000s($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria whereUpdatedAt($value)
 * @property string|null $_125ossd
 * @property string|null $_250ossd
 * @property string|null $_500ossd
 * @property string|null $_1000ossd
 * @property string|null $_1500ossd
 * @property string|null $_2000ossd
 * @property string|null $_3000ossd
 * @property string|null $_4000ossd
 * @property string|null $_6000ossd
 * @property string|null $_8000ossd
 * @property string|null $_125osss
 * @property string|null $_250osss
 * @property string|null $_500osss
 * @property string|null $_1000osss
 * @property string|null $_1500osss
 * @property string|null $_2000osss
 * @property string|null $_3000osss
 * @property string|null $_4000osss
 * @property string|null $_6000osss
 * @property string|null $_8000osss
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where1000ossd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where1000osss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where125ossd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where125osss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where1500ossd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where1500osss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where2000ossd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where2000osss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where250ossd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where250osss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where3000ossd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where3000osss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where4000ossd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where4000osss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where500ossd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where500osss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where6000ossd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where6000osss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where8000ossd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Audiometria where8000osss($value)
 * @mixin \Eloquent
 */
class Audiometria extends Model
{
    use HasFactory;

    protected $table = 'audiometrias';
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
