<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendMailForgotPasswordEvent;
use App\Http\Controllers\Controller;
use App\Models\Password;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

//        if ($this->verifyToken($request->email)) {
//            return back()->toast('Um link para redefinir a senha foi enviado para o seu e-mail.', 'error');
//        }
        $token = substr(md5($request->email), 0, 255);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            Password::where('email', $request->email)->delete();
            $this->createPasswordReset($token, $request->email);
            event(new SendMailForgotPasswordEvent($token, $request->email, $user->name));
        }

        return redirect()->route('password.request')->toast('Um link para redefinir a senha foi enviado para o seu e-mail.', 'success');
    }

    /**
     * @param $email
     * @return bool
     */
    private function verifyToken($email): bool
    {
        $password = Password::where('email', $email)->first();
        if ($password) {
            if ($password->expired_at > now()) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $token
     * @param string $email
     * @return void
     */
    private function createPasswordReset(string $token, string $email) {
        Password::create([
            'email' => $email,
            'token' => $token,
            'expired_at' => now()->addHour(1),
        ]);
    }
}
