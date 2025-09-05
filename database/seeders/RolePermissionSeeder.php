<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // daftar permission
        $permissions = [
            'view_beranda',
            'view_surat-masuk',
            'view_surat-keluar',
            'view_arsip',
            'view_disposisi',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission, 'guard_name' => 'web']
            );
        }

        // role admin
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $admin->syncPermissions([
            'view_beranda',
            'view_surat-masuk',
            'view_surat-keluar',
            'view_disposisi',
            'view_arsip',
        ]);

        // role pimpinan
        $pimpinan = Role::firstOrCreate(['name' => 'pimpinan', 'guard_name' => 'web']);
        $pimpinan->syncPermissions([
            'view_beranda',
            'view_surat-masuk',
            'view_disposisi',
        ]);

        // role pegawai
        $pegawai = Role::firstOrCreate(['name' => 'pegawai', 'guard_name' => 'web']);
        $pegawai->syncPermissions([
            'view_beranda',
            'view_surat-masuk',
            'view_disposisi',
        ]);
    }
}
