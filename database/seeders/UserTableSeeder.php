<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // membuat user
        $user = User::create([
            'name'      => 'Syahrizaldev',
            'email'     => 'izaldev@gmail.com',
            'password'  => bcrypt('password'),
        ]);

        // mengambil semua permission
        $permissions = Permission::all();

        // mengambil role admin
        $role = Role::find(1);

        // menambahkan permission ke role
        $role->syncPermissions($permissions);

        // menambahkan role ke user
        $user->assignRole($role);
    }
}
