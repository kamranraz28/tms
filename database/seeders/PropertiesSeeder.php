<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
            'id'                 => 2,
            'position_id'        => 2,
            'name'               => 'Flat-1',
            'address'            => 'Mirpur DOHS',
            'status'             => 1,
            'created_at'         => Carbon::parse('2025-05-25 02:35:42'),
            'updated_at'         => Carbon::parse('2025-05-25 04:19:20'),
        ]);
    }
}
