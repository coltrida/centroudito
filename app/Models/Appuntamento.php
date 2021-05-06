<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appuntamento extends Model
{
    use HasFactory;

    protected $table = 'appuntamentos';

    public function filiale()
    {
        return $this->belongsTo(Filiale::class);
    }

    public function recapito()
    {
        return $this->belongsTo(Recapito::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
