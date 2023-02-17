<?php


namespace App\Services;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function login($mail, $password)
    {
        $user = User::with('ruolo', 'recapito')->where('email', $mail)->first();

        /*if($user->ruolo_id === 1){
            $user->password = Hash::make($password);
            $user->cleanpassword = $password;
            $user->save();
        }*/

        if (!$user || !Hash::check($password, $user->password)) {
            return [
                'message' => ['Le Credenziali non corrispondono'],
                'stato' => 'errore'
            ];
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $propieta = 'login';
        $testo = 'login di '.$user->name;
        $log = new LoggingService();
        $log->scriviLog($user->name, $user->name, $user->name, $propieta, $testo);

        return [
            'user' => $user,
            'token' => $token,
            'stato' => 'successo'
        ];
    }

    public function register($request)
    {
        $user = User::with('ruolo', 'recapito')->where('email', $request->email)->first();

        if (!$user || !Hash::check($request->oldPassword, $user->password)) {
            return [
                'message' => 'Le Credenziali non corrispondono',
                'stato' => 'errore'
            ];
        }

        if ($request->repeatpassword !== $request->password) {
            return [
                'message' => 'La nuova password e la ripetizione password non coincidono',
                'stato' => 'errore'
            ];
        }

        $user->cleanpassword = $request->password;
        $user->password = Hash::make($request->password);
        $user->email_verified_at = Carbon::now();
        $user->save();
        $user = User::with('ruolo', 'recapito')->where('email', $request->email)->first();

        $token = $user->createToken('my-app-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
            'stato' => 'successo'
        ];
    }
}
