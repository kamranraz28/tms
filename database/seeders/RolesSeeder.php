<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => Carbon::parse('2024-10-02 23:54:51'),
                'updated_at' => Carbon::parse('2024-10-02 23:54:51'),
            ],
            [
                'id' => 2,
                'name' => 'Editor',
                'guard_name' => 'web',
                'created_at' => Carbon::parse('2024-10-02 23:55:15'),
                'updated_at' => Carbon::parse('2024-10-02 23:55:15'),
            ],
            [
                'id' => 3,
                'name' => 'Visitor',
                'guard_name' => 'web',
                'created_at' => Carbon::parse('2024-10-03 03:24:12'),
                'updated_at' => Carbon::parse('2024-10-03 03:24:12'),
            ],
        ]);
    }
}
