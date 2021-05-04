<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{
    use HasFactory;

    protected $table = 'provas';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    /*public function listino()
    {
        return $this->belongsToMany(Listino::class, 'product_prova', 'prova_id', 'product_id');
    }*/

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_prova', 'prova_id', 'product_id');
    }
}
