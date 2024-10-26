<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'full_name' => 'admin',
            'email' => 'admin@admin.com',
            'country_code' => 'US',
            'phone' => '1234567890',
            'password' => '123@Admin',
            'active' => true,
            'country_id' => 1,
            'language_id' => 1,
            'type_id' => 1,
            'remember_token' => Str::random(16),
        ]);

        $admin = Admin::create([
            'full_name' => 'SuperAdmin',
            'email' => 'admin2@admin.com',
            'country_code' => 'US',
            'phone' => '123456',
            'password' => '123@Admin',
            'type_id' => 1,
            'remember_token' => Str::random(16),
            'country_id' => 1,
            'active' => true,
            'language_id' => 1,
        ]);
        $role = Role::where('name', 'super_admin')->first();

        // Attach the role to the user
        if ($role) {
            $admin->attachRole($role, 'super_admin');  // or $user->addRole($role);
        } else {
            $this->command->error('Role "super_admin" not found.');
        }
    }
}
