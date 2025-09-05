<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            'Kepala Sekolah',
            'Waka Kurikulum',
            'Waka Kesiswaan',
            'Tata Usaha',
        ];

        foreach ($positions as $position) {
            Position::updateOrCreate(
                ['name' => $position], // cek berdasarkan kolom name
                ['name' => $position]  // kalau ada update, kalau belum ada create
            );
        }
    }
}
