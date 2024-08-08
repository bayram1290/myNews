<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        
        $super_admin = Role::create(['name' => 'superAdmin']);
        $admin = Role::create(['name' => 'admin']);
        $content_manager = Role::create(['name' => 'contentManager']);

        $super_admin->givePermissionTo(Permission::all());

        $content_manager->givePermissionTo([
            'create-news',
            'edit-news',
            'delete-news'
        ]);

        $admin->givePermissionTo([
            'create-news',
            'edit-news',
            'delete-news',
            'create-user',
            'edit-user',
            'delete-user',            
        ]);

    }
}
