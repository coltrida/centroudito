<?php


namespace App\Services;


use Illuminate\Support\Facades\Auth;

class UserService
{
    public function userNonAutorizzato($idAudio)
    {
        return $idAudio != Auth::id();
    }
}
