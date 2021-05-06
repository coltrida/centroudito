<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fattura extends Model
{
    use HasFactory;

    protected $table = 'fatturas';

    public function rata()
    {
        return $this->hasMany(Ratefattura::class);
    }
}
