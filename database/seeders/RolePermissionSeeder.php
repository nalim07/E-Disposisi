<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat permission untuk semua fitur
        $permissions = [
            'view_beranda',
            'view_surat-masuk',
            'view_surat-keluar',
            'view_arsip',
            'view_disposisi',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Membuat role admin dan memberikan permission
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'view_beranda',
            'view_surat-masuk',
            'view_surat-keluar',
            'view_disposisi',
            'view_arsip'
        ]);

        // Membuat role pimpinan dan memberikan permission
        $pimpinan = Role::create(['name' => 'pimpinan']);
        $pimpinan->givePermissionTo([
            'view_beranda',
            'view_surat-masuk',
            'view_disposisi'
        ]);

        // Membuat role pegawai dan memberikan permission
        $pegawai = Role::create(['name' => 'pegawai']);
        $pegawai->givePermissionTo([
            'view_beranda',
            'view_surat-masuk',
            'view_disposisi'
        ]);
    }
}
