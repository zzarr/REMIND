<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TingkatStresSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tingkat_stres')->insert([
            [
                'nama_level' => 'rendah',
                'nilai_min' => 0,
                'nilai_max' => 32,
                'created_at' => Carbon::parse('2025-04-28 11:33:13'),
                'updated_at' => Carbon::parse('2025-04-28 11:33:13'),
            ],
            [
                'nama_level' => 'sedang',
                'nilai_min' => 33,
                'nilai_max' => 66,
                'created_at' => Carbon::parse('2025-04-28 11:36:38'),
                'updated_at' => Carbon::parse('2025-04-28 11:36:38'),
            ],
            [
                'nama_level' => 'tinggi',
                'nilai_min' => 67,
                'nilai_max' => 100,
                'created_at' => Carbon::parse('2025-04-28 11:37:24'),
                'updated_at' => Carbon::parse('2025-04-28 11:37:24'),
            ],
        ]);
    }
}
