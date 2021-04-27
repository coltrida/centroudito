<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listino extends Model
{
    use HasFactory;

    protected $table = 'listinos';

    public function fornitore()
    {
        return $this->belongsTo(Fornitore::class, 'fornitore_id', 'id');
    }
}
