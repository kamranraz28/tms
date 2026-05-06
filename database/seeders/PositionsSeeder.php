<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            [
                'id' => 2,
                'name' => 'North-3/A',
                'status' => 1,
                'created_at' => '2025-05-25 02:08:43',
                'updated_at' => '2025-05-25 02:08:43',
            ],
        ]);
    }
}
