<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function config;

class Filiale extends Model
{
    use HasFactory;

    protected $table = 'filiales';

    public function users()
    {
        return $this->belongsToMany(User::class, 'filiale_user', 'filiale_id', 'user_id')
            ->withPivot(['id']);
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'filiale_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function audio()
    {
        return $this->belongsToMany(User::class, 'filiale_user', 'filiale_id', 'user_id')
            ->where('ruolo', config('enum.ruoli.audio'))
            ->withPivot(['id']);
    }
}
