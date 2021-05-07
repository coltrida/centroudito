<?php


namespace App\Services;


use App\Models\Budget;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function config;
use function dd;
use function setlocale;
use const LC_TIME;

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
        setlocale(LC_TIME, 'it_IT');
        Carbon::setLocale('it');
        $nomeMese = Carbon::now()->monthName;
        $mese = Carbon::now()->month;
        $anno = Carbon::now()->year;

        /*dd(User::with(['filiale', 'provaInCorso', 'provaFinalizzata' => function($z) use($mese, $anno){
            $z->where([['mese_fine', $mese], ['anno_fine', $anno]]);
        }, "budget:id,budgetAnno,$nomeMese as target"])
            ->withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                $g->where([['mese_fine', $mese], ['anno_fine', $anno]]);
            }], 'tot')
            ->withCount(['prova' => function($q){
                $q->where('stato', config('enum.statoAPA.prova'));
            }])
            ->where('ruolo', config('enum.ruoli.audio'))->get());*/

        return User::with(['filiale', 'provaInCorso', 'provaFinalizzata' => function($z) use($mese, $anno){
            $z->where([['mese_fine', $mese], ['anno_fine', $anno]]);
                }, "budget"])
            ->withSum(['provaFinalizzata' => function($g) use($mese, $anno){
                $g->where([['mese_fine', $mese], ['anno_fine', $anno]]);
                }], 'tot')
            ->withCount(['prova' => function($q){
                $q->where('stato', config('enum.statoAPA.prova'));
                }])
            ->where('ruolo', config('enum.ruoli.audio'))->get();
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
        return User::with(['provaInCorso' => function ($q){
            $q->with(['product']);
        }])->find(Auth::id())->provaInCorso;
    }

    public function finalizzatiDelMese()
    {
        $oggi = Carbon::now();

        return User::with(['provaFinalizzata' => function ($q) use($oggi){
            $q->with(['product'])->where([
                ['mese_fine', $oggi->month],
                ['anno_fine', $oggi->year],
            ]);
        }])->find(Auth::id())->provaFinalizzata;
    }

    public function appuntamentiOggi()
    {
        $oggi = Carbon::now()->format('Y-m-d');
        return User::with(['appuntamenti' => function ($q) use($oggi){
            $q->with('client')->where('giorno', $oggi);
        }])->find(Auth::id())->appuntamenti;
    }

    public function appuntamentiDomani()
    {
        $domani = Carbon::tomorrow()->format('Y-m-d');
        return User::with(['appuntamenti' => function ($q) use($domani){
            $q->with('client')->where('giorno', $domani);
        }])->find(Auth::id())->appuntamenti;
    }

    public function associaBudget($request)
    {
        //dd($request);
        if ($request['modifica'] == 0){
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
        } else {
            $budget = User::with('budget')->find($request['audioId'])->budget;
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
            return $budget->save();
        }

    }

    public function getInfoBudget($id)
    {
        setlocale(LC_TIME, 'it_IT');
        Carbon::setLocale('it');
        //$nomeMese = Carbon::now()->monthName;

        //dd(User::with("budget:id,budgetAnno,$nomeMese as target")->find($id)->budget);

        //return User::with("budget:id,budgetAnno,$nomeMese as target")->find($id)->budget;
        return User::with("budget")->find($id)->budget;
    }

    public function getBudgetDelMese($id)
    {
        setlocale(LC_TIME, 'it_IT');
        Carbon::setLocale('it');
        $nomeMese = Carbon::now()->monthName;

        //dd(User::with("budget:id,budgetAnno,$nomeMese as target")->find($id)->budget);

        return User::with("budget:id,budgetAnno,$nomeMese as target")->find($id)->budget;
        //return User::with("budget")->find($id)->budget;
    }

    public function disassociaBudget($id)
    {
        $user = User::find($id);
        $user->budget_id = null;
        $user->save();
    }
}
