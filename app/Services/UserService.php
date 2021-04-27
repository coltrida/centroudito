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
        return User::with('filiale')->where('ruolo', config('enum.ruoli.audio'))->get();
    }

    public function getAmministrazione()
    {
        return User::with('filiale')->where('ruolo', config('enum.ruoli.segreteria'))->get();
    }

    public function inserisci($request)
    {
        return User::insert([
            'name' => $request['nome'],
            'email' => $request['email'],
            'filiale_id' => $request['filiale_id'],
            'ruolo' => $request['ruolo'],
        ]);
    }

    public function rimuovi($id)
    {
        return User::find($id)->delete();
    }
}
