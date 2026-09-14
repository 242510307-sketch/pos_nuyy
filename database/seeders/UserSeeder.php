<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $kasirRole = Role::where('name', 'kasir')->firstOrFail();

        User::updateOrCreate(
            ['email' => 'admin@fruitsmart.test'],
            [
                'name' => 'Admin',
                'password' => 'password',
                'role_id' => $adminRole->id,
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'kasir@fruitsmart.test'],
            [
                'name' => 'Kasir',
                'password' => 'password',
                'role_id' => $kasirRole->id,
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@fruitsmart.test'],
            [
                'name' => 'User',
                'password' => 'password',
                'role_id' => $kasirRole->id,
                'email_verified_at' => now(),
            ]
        );
    }
}
