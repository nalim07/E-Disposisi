<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan role sudah ada (dibuat di RolePermissionSeeder)
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $pimpinanRole = Role::firstOrCreate(['name' => 'pimpinan', 'guard_name' => 'web']);
        $pegawaiRole = Role::firstOrCreate(['name' => 'pegawai', 'guard_name' => 'web']);

        // User admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'employee_id' => 1,
            ]
        );
        $admin->assignRole($adminRole);

        // User pimpinan
        $pimpinan = User::firstOrCreate(
            ['email' => 'pimpinan@gmail.com'],
            [
                'username' => 'pimpinan',
                'password' => bcrypt('pimpinan'),
                'employee_id' => 2,
            ]
        );
        $pimpinan->assignRole($pimpinanRole);

        // User pegawai
        $pegawai = User::firstOrCreate(
            ['email' => 'pegawai@gmail.com'],
            [
                'username' => 'pegawai',
                'password' => bcrypt('pegawai'),
                'employee_id' => 3,
            ]
        );
        $pegawai->assignRole($pegawaiRole);
    }
}
