<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        Role::create(['name' => 'LandLord', 'guard_name' => 'web']);
        Role::create(['name' => 'Tenant', 'guard_name' => 'web']);

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole('Admin');

        $landlord = User::factory()->create([
            'name' => 'LandLord',
            'email' => 'landlord@example.com',
            'password' => bcrypt('landlord')
        ]);

        $landlord->assignRole('LandLord');

        $tenant = User::factory()->create([
            'name' => 'Tenant',
            'email' => 'tenant@example.com',
            'password' => bcrypt('tenant')
        ]);

        $tenant->assignRole('Tenant');
    }
}
