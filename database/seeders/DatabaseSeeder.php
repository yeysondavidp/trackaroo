<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create permissions
        Permission::create(['name' => 'view projects']);
        Permission::create(['name' => 'start project']);
        Permission::create(['name' => 'complete project']);
        Permission::create(['name' => 'manage users']);

        // Create roles
        $technician = Role::create(['name' => 'technician']);
        $supervisor = Role::create(['name' => 'supervisor']);
        $admin      = Role::create(['name' => 'admin']);

        // Asignar permisos a roles
        $technician->givePermissionTo(['view projects', 'start project']);
        $supervisor->givePermissionTo(['view projects', 'start project', 'complete project']);
        $admin->givePermissionTo(Permission::all());

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('secret123'),
        ]);
        $user->assignRole('admin');
    }
}
