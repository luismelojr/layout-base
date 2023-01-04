<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['admin', 'user'] as $role) {
            \Spatie\Permission\Models\Role::create([
                'name' => $role,
                'description' => $role == 'admin' ? 'Cargo de administrador, e tera acesso a tudo' : 'Cargo de usuario tera acesso a algumas coisas'
            ]);
        }
    }
}
