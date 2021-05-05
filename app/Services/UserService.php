<?php


namespace App\Services;


use App\Models\Budget;
use App\Models\User;
use Carbon\Carbon;
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

    public function proveInCorso()
    {
        return User::with(['prova' => function ($q){
            $q->with(['product'])->where('stato', 'inCorso');
        }])->find(Auth::id())->prova;
    }

    public function finalizzatiDelMese()
    {
        $oggi = Carbon::now();

        return User::with(['prova' => function ($q) use($oggi){
            $q->with(['product'])->where([
                ['stato', 'finalizzato'],
                ['mese_fine', $oggi->month],
                ['anno_fine', $oggi->year],
            ]);
        }])->find(Auth::id())->prova;
    }

    public function appuntamentiOggi()
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return User::with(['appuntamenti' => function ($q) use($oggi){
            $q->where('giorno', $oggi);
        }])->find(Auth::id())->appuntamenti;
    }

    public function appuntamentiDomani()
    {
        $domani = Carbon::tomorrow()->format('Y-m-d');
        return User::with(['appuntamenti' => function ($q) use($domani){
            $q->where('giorno', $domani);
        }])->find(Auth::id())->appuntamenti;
    }

    public function associaBudget($request)
    {
        $budget = new Budget();
        $budget->budgetAnno = $request['budget'];
        $budget->premio = 0;
        $budget->stipendio = $request['stipendioMese'];
        $budget->provvigione = $request['provvigioni'];
        $budget->gennaio = $request[0];
        $budget->febbraio = $request[1];
        $budget->marzo = $request[2];
        $budget->aprile = $request[3];
        $budget->maggio = $request[4];
        $budget->giugno = $request[5];
        $budget->luglio = $request[6];
        $budget->agosto = $request[7];
        $budget->settembre = $request[8];
        $budget->ottobre = $request[9];
        $budget->novembre = $request[10];
        $budget->dicembre = $request[11];
        $budget->save();

        $user = User::find($request['audioId']);
        $user->budget_id = $budget->id;
        return $user->save();
    }

    public function getInfoBudget($id)
    {
        return User::with('budget')->find($id)->budget;
    }

    public function disassociaBudget($id)
    {
        $user = User::find($id);
        $user->budget_id = null;
        $user->save();
    }
}
