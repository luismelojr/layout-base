<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserService
{
    public function __construct(
        private User $user
    ){}

    public function getAll(Request $request)
    {
        $users = $this->user->query()
            ->when($request->has('name'), function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->name}%");
            })->when($request->has('email'), function ($query) use ($request) {
                $query->where('email', 'like', "%{$request->email}%");
            })->when($request->has('is_active'), function ($query) use ($request) {
                if (isset($request->is_active)) {
                    $query->where('is_active', $request->is_active);
                }
            });

        return [
            'users' => $users->with('roles')->paginate(10)->withQueryString(),
            'filters' => $request->query()
        ];
    }

    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = $this->user->create($data);
        $user->assignRole($data['role']);
        return $user;
    }

    public function update(array $data, User $user)
    {
        $user->syncRoles($data['role']);
        return $user->update($data);
    }

    public function delete(User $user)
    {
        return $user->delete();
    }

    public function getRoles()
    {
        return Role::select('id', 'name')->get();
    }

    public function status(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();
    }
}
