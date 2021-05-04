<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornitore extends Model
{
    use HasFactory;

    protected $table = 'fornitores';

    public function listino()
    {
        return $this->hasMany(Listino::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
