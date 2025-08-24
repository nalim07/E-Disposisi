<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'position_id'    => 1, // pastikan posisi dengan id 1 sudah ada di tabel positions
                'employee_code'  => 'EMP001',
                'fullname'       => 'M. Syiraj Al Ayubi',
                'email'          => 'syirajalayubi@gmail.com',
                'gender'         => 'Male',
                'religion'       => 'Islam',
                'place_of_birth' => 'Serang',
                'date_of_birth'  => '2003-05-10',
                'address'        => 'Jl. Kepuh',
                'phone_number'   => '081234567890',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'position_id'    => 2,
                'employee_code'  => 'EMP002',
                'fullname'       => 'Jane Smith',
                'email'          => 'jane.smith@example.com',
                'gender'         => 'Female',
                'religion'       => 'Islam',
                'place_of_birth' => 'Bandung',
                'date_of_birth'  => '1992-08-20',
                'address'        => 'Jl. Asia Afrika No. 45, Bandung',
                'phone_number'   => '081298765432',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'position_id'    => 3,
                'employee_code'  => 'EMP003',
                'fullname'       => 'Michael Johnson',
                'email'          => 'michael.j@example.com',
                'gender'         => 'Male',
                'religion'       => 'Hindu',
                'place_of_birth' => 'Denpasar',
                'date_of_birth'  => '1988-12-05',
                'address'        => 'Jl. Raya Ubud No. 12, Bali',
                'phone_number'   => '081355667788',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);

        // Employee::factory()->count(10)->create();
    }
}
