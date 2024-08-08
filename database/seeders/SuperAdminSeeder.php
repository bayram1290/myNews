<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class SuperAdminSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {

        $default_users  = [
            (object) ['login' => 'superadmin',  'password' => 'superpassword', 'role' => 'superAdmin'],
            (object) ['login' => 'admin',  'password' => 'adminpassword', 'role' => 'admin'],
            (object) ['login' => 'manager',  'password' => 'managerpassword', 'role' => 'contentManager']
        ];

        foreach ($default_users as $user) {
            $single_user = User::create([
                'login' => $user->login,
                'password' => Hash::make($user->password)
            ]);

            $single_user->assignRole($user->role);
        }
    }
}
