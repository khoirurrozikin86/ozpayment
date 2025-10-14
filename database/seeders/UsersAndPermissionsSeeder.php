<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Spatie\Permission\Models\{Role, Permission};
use Spatie\Permission\PermissionRegistrar;

class UsersAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $guard = 'web';

        // --- 1) Roles ---
        $roles = collect(['user', 'admin', 'super_admin'])
            ->mapWithKeys(fn($r) => [$r => Role::firstOrCreate(['name' => $r, 'guard_name' => $guard])]);

        // --- 2) Modules (user, role, permission) ---
        $modules = [
            'user'       => ['menu', 'create', 'read', 'update', 'delete'],
            'role'       => ['menu', 'create', 'read', 'update', 'delete'],
            'permission' => ['menu', 'create', 'read', 'update', 'delete'],
        ];

        foreach ($modules as $group => $actions) {
            foreach ($actions as $action) {
                $name = "{$group}.{$action}";

                // Buat permission (atribut minimal)
                $perm = Permission::firstOrCreate(
                    ['name' => $name, 'guard_name' => $guard]
                );

                // Optional backfill group_name jika kolomnya ada
                if (Schema::hasColumn($perm->getTable(), 'group_name') && $perm->group_name !== $group) {
                    $perm->group_name = $group;
                    $perm->save();
                }
            }
        }

        // --- 3) Mapping role → permissions ---
        // role user: read user (mis. profil/lihat data user)
        $roles['user']->syncPermissions([
            'user.read',
        ]);

        // role admin: semua CRUD user & role, TIDAK termasuk permission management
        $roles['admin']->syncPermissions([
            'user.menu',
            'user.create',
            'user.read',
            'user.update',
            'user.delete',
            'role.menu',
            'role.create',
            'role.read',
            'role.update',
            'role.delete',
        ]);

        // super_admin: semua permission yang ada
        $roles['super_admin']->syncPermissions(Permission::pluck('name')->all());

        // --- 4) Akun default ---
        $user = User::updateOrCreate(
            ['email' => 'user@stylus.local'],
            ['name' => 'Default User', 'password' => Hash::make('password')]
        );
        $user->syncRoles(['user']);

        $admin = User::updateOrCreate(
            ['email' => 'admin@stylus.local'],
            ['name' => 'Admin Stylus', 'password' => Hash::make('password')]
        );
        $admin->syncRoles(['admin']);

        $super = User::updateOrCreate(
            ['email' => 'super@stylus.local'],
            ['name' => 'Super Admin Stylus', 'password' => Hash::make('password')]
        );
        $super->syncRoles(['super_admin']);

        // --- 5) Reset cache Spatie ---
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
