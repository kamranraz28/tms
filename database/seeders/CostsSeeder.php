<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('costs')->insert([
            [
                'id' => 2,
                'date' => '2025-05-01',
                'status' => 1,
                'created_at' => '2025-05-27 05:05:02',
                'updated_at' => '2025-05-27 05:05:02',
            ],
            [
                'id' => 3,
                'date' => '2025-05-02',
                'status' => 1,
                'created_at' => '2025-05-27 05:08:35',
                'updated_at' => '2025-05-27 05:08:35',
            ],
            [
                'id' => 4,
                'date' => '2025-05-03',
                'status' => 1,
                'created_at' => '2025-05-27 05:21:13',
                'updated_at' => '2025-05-27 05:21:13',
            ],
        ]);
    }
}
