<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
            'full_name' => 'SuperAdmin',
            'email' => 'user@admin.com',
            'country_code' => 'US',
            'phone' => '123456',
            'password' => bcrypt('123456789'),
            'country_code' => 1,
            'language_id' => 1,

        ]);
        // Get the 'super_admin' role
        $role = Role::where('name', 'super_admin')->first();

        // Attach the role to the user
        if ($role) {
            $user->attachRole($role,'super_admin');  // or $user->addRole($role);
        } else {
            $this->command->error('Role "super_admin" not found.');
        }
    }
}
