<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Activitylog
 *
 * @property int $id
 * @property string|null $log_name
 * @property string $description
 * @property string|null $subject_type
 * @property string|null $event
 * @property int|null $subject_id
 * @property string|null $causer_type
 * @property int|null $causer_id
 * @property mixed|null $properties
 * @property string|null $batch_uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereBatchUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereCauserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereCauserType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereEvent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereLogName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereSubjectType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activitylog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Activitylog extends Model
{
    use HasFactory;

    protected $table = 'activity_log';
    protected $guarded = [];
}
