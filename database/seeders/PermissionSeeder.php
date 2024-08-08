<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void  {
        
        $user_permissions = [
            'create-news',
            'edit-news',
            'delete-news',
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user'
         ];

         foreach ($user_permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
    }
}
