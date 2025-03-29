<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //user admin
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        $admin->assignRole('admin');

        //user pimpinan
        $pimpinan = User::create([
            'username' => 'pimpinan',
            'email' => 'pimpinan@gmail.com',
            'password' => bcrypt('pimpinan'),
        ]);
        $pimpinan->assignRole('pimpinan');

        //user pegawai
        $pegawai = User::create([
            'username' => 'pegawai',
            'email' => 'pegawai@gmail.com',
            'password' => bcrypt('pegawai'),
        ]);
        $pegawai->assignRole('pegawai');
    }
}
