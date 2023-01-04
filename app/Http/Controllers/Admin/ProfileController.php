<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ProfileController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Profile/Index', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->update($request->only('name', 'email'));

        return redirect()->back()->toast('Usuário atualizado com sucesso!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            return redirect()->back()->toast('Senha atual incorreta!', 'error');
        }

        $user = auth()->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->toast('Senha atualizada com sucesso!');
    }
}
