<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function config;
use function dd;

class UserService
{
    public function getUser()
    {
        return User::find(Auth::id());
    }

    public function getFiliali()
    {
        return User::with('filiale')->find(Auth::id())->orderBy('nome');
    }

    public function getRecapitiOfUser()
    {
        return User::with('recapito')->find(Auth::id())->recapito;
    }

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

    public function isAudio()
    {
        return Auth::user()->isAudio ? true : false;
    }

    public function isAdmin()
    {
        return Auth::user()->isAdmin ? true : false;
    }

    public function isAmministrazione()
    {
        return Auth::user()->isAmministrazione ? true : false;
    }
}
