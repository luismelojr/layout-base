<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['create', 'read', 'update', 'delete'] as $action) {
            foreach (['users', 'roles'] as $resource) {
                \Spatie\Permission\Models\Permission::create([
                    'name' => $action . '-' . $resource,
                ])->assignRole('admin');
            }
        }

        \Spatie\Permission\Models\Permission::create([
            'name' => 'status-users',
        ])->assignRole('admin');
    }
}
