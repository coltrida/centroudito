<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\Agenda
 *
 * @property int $id
 * @property string $nome
 * @property int $user_id
 * @property int $settimana
 * @property string|null $lun
 * @property string|null $mar
 * @property string|null $mer
 * @property string|null $gio
 * @property string|null $ven
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda query()
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereGio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereLun($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereMar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereMer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereSettimana($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereVen($value)
 * @property string|null $sab
 * @property-read mixed $luniniz
 * @property-read mixed $mariniz
 * @property-read mixed $meriniz
 * @property-read mixed $sabiniz
 * @property-read mixed $veniniz
 * @property-read mixed $gioiniz
 * @method static \Illuminate\Database\Eloquent\Builder|Agenda whereSab($value)
 * @mixin \Eloquent
 */
class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agendas';
    protected $guarded = [];
    protected $appends = ['luniniz', 'mariniz', 'meriniz', 'gioiniz', 'veniniz', 'sabiniz'];

    public function getLuninizAttribute()
    {
        return Str::substr($this->lun, 0, 1);
    }

    public function getMarinizAttribute()
    {
        return Str::substr($this->mar, 0, 1);
    }

    public function getMerinizAttribute()
    {
        return Str::substr($this->mer, 0, 1);
    }

    public function getgioinizAttribute()
    {
        return Str::substr($this->gio, 0, 1);
    }

    public function getVeninizAttribute()
    {
        return Str::substr($this->ven, 0, 1);
    }

    public function getSabinizAttribute()
    {
        return Str::substr($this->sab, 0, 1);
    }
}
