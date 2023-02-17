<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Documento
 *
 * @property int $id
 * @property int $client_id
 * @property string $tipo
 * @property string $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Documento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento query()
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereUpdatedAt($value)
 * @property int|null $prova_id
 * @method static \Illuminate\Database\Eloquent\Builder|Documento whereProvaId($value)
 * @mixin \Eloquent
 */
class Documento extends Model
{
    use HasFactory;
    protected $table = 'documentos';
    protected $guarded = [];
}
