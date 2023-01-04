<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Password;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ResetPasswordController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function index(Request $request): RedirectResponse|Response
    {
        if ($request->has('token') && $this->verifyToken($request->query('token'))) {
            $token = $request->get('token');
            return Inertia::render('Auth/ResetPassword', ['token' => $token]);
        }

        return redirect()->route('password.request');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($this->verifyToken($request->token)) {
            $password = Password::where('token', $request->token)->first();
            $user = User::where('email', $password->email)->first();
            $user->password = bcrypt($request->password);
            $user->save();
            $password->delete();
            return redirect()->route('login')->toast('Senha alterada com sucesso.', 'success');
        }

        return redirect()->route('password.request');
    }

    /**
     * @param string $token
     * @return bool
     */
    private function verifyToken(string $token): bool
    {
        $password = Password::where('token', $token)->first();
        if ($password) {
            if ($password->expired_at > now()) {
                return true;
            }
        }
        return false;
    }
}
