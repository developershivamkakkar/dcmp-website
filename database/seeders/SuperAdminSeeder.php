<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or find the user
        $user = User::firstOrCreate([
            'email' => 'admin@admin.com'
        ], [
            'name' => 'Super Admin',
            'password' => bcrypt('bulletaa500'),
        ]);

        // Create or find the role
        $role = Role::firstOrCreate([
            'name' => 'super admin',
            'guard_name' => 'admin'
        ]);

        // Define the permissions with the guard name
        $permissions = [
            // Access Control Permissions
            'view permissions',
            'create permission',
            'delete permission',
            'update permission',
            'view roles',
            'delete role',
            'create role',
            'update role',
            'give-permission-to-role',
            'view users',
            'delete user',
            'create user',
            'update user',
            // Module Permissions
            'module-announcements',
            'module-achievements',
            'module-blogs',
            'module-downloads',
            'module-enquires',
            'module-events',
            'module-explore-banners',
            'module-faqs',
            'module-gallery',
            'module-hero-banners',
            'module-landing-page',
            'module-mandatory-disclosure',
            'module-manage-menu-items',
            'module-menu-delete',
            'module-manage-learning-partners',
            'module-member-delete',
            'module-page-editor',
            'module-popups',
            'module-resource-list',
            'module-site-settings',
            'module-testimonials',
            'module-transfer-certificates',
        ];

        // Create permissions if they don't exist and assign them to the role
        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate([
                'name' => $permissionName,
                'guard_name' => 'admin'
            ]);
        }

        // Sync all permissions with the role
        $role->syncPermissions(Permission::where('guard_name', 'admin')->get());

        // Assign the role to the user
        $user->assignRole($role);
    }
}
