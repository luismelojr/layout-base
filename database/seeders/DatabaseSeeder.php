<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class, PermissionSeeder::class]);

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'junimhs10@gmail.com',
             'password' => bcrypt('junior')
         ])->assignRole('admin');
    }
}
