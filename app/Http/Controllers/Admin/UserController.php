<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\UserCreateRequest;
use App\Http\Requests\Admin\Users\UserEditRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ){}

    public function index(Request $request)
    {
        $this->authorize('read-users');
        return Inertia::render('Admin/Users/Index', [
            'users' => $this->userService->getAll($request)['users'],
            'filters' => $this->userService->getAll($request)['filters']
        ]);
    }

    public function create()
    {
        $this->authorize('create-users');
        return Inertia::render('Admin/Users/Create', [
            'roles' => $this->userService->getRoles()
        ]);
    }

    public function store(UserCreateRequest $request)
    {
        $this->authorize('create-users');
        $this->userService->create($request->validated());
        return redirect()->route('admin.users.index')->toast('Usuário cadastrado com sucesso!');
    }

    public function edit(User $user)
    {
        $this->authorize('update-users');
        return Inertia::render('Admin/Users/Edit', [
            'user' => $user->load('roles'),
            'roles' => $this->userService->getRoles()
        ]);
    }

    public function update(UserEditRequest $request, User $user)
    {
        $this->authorize('update-users');
        $this->userService->update($request->validated(), $user);
        return redirect()->route('admin.users.index')->toast('Usuário atualizado com sucesso!');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete-users');
        if ($user->id == auth()->user()->id) {
            return redirect()->route('admin.users.index')->toast('Você não pode excluir seu próprio usuário!', 'error');
        }

        $this->userService->delete($user);
        return redirect()->route('admin.users.index')->toast('Usuário excluído com sucesso!');
    }

    public function status(User $user)
    {
        $this->authorize('status-users');
        if ($user->id == auth()->user()->id && $user->is_active == 1) {
            return redirect()->route('admin.users.index')->toast('Você não pode desativar seu próprio usuário!', 'error');
        }
        $this->userService->status($user);
        return redirect()->route('admin.users.index')->toast('Status do usuário atualizado com sucesso!');
    }
}
