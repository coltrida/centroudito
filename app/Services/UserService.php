<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function config;
use function dd;

class UserService
{
    public function userNonAutorizzato($idAudio)
    {
        return $idAudio != Auth::id();
    }

    public function getAudioprotesisti()
    {
        return User::where('ruolo', config('enum.ruoli.audio'))->get();
    }

    public function inserisciAudioprotesista($request)
    {
        return User::insert([
            'name' => $request['nome'],
            'email' => $request['email'],
            'id_filiale' => $request['id_filiale'],
            'ruolo' => config('enum.ruoli.audio'),
        ]);
    }
}
