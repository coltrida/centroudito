<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ventaglio
 *
 * @property int $id
 * @property int $user_id
 * @property int $tot
 * @property int $anno
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $M30
 * @property string $M50
 * @property string $M70
 * @property string $M90
 * @property string $LIVIO1200AI
 * @property string $LIVIO1600AI
 * @property string $LIVIO2000AI
 * @property string $LIVIO2400AI
 * @property string $LIVIO2400EDGEAILITHIUM
 * @property string $LIVIOAI1200LITHIUM
 * @property string $LIVIOAI1600LITHIUM
 * @property string $LIVIOAI2000LITHIUM
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio query()
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereAnno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereLIVIO1200AI($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereLIVIO1600AI($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereLIVIO2000AI($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereLIVIO2400AI($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereLIVIO2400EDGEAILITHIUM($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereLIVIOAI1200LITHIUM($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereLIVIOAI1600LITHIUM($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereLIVIOAI2000LITHIUM($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereM30($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereM50($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereM70($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereM90($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereTot($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereUserId($value)
 * @property string $AUDEOM30
 * @property string $AUDEOM50
 * @property string $AUDEOM70
 * @property string $AUDEOM90
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereAUDEOM30($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereAUDEOM50($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereAUDEOM70($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Ventaglio whereAUDEOM90($value)
 * @mixin \Eloquent
 */
class Ventaglio extends Model
{
    use HasFactory;
    protected $table = 'ventaglios';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
