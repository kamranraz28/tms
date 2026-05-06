<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'id' => 1,
                'header_color' => '#111827',
                'sidebar_color' => '#0F172A',
                'button_color' => '#2563EB',
                'created_at' => Carbon::create('2026', '05', '04', '03', '50', '26'),
                'updated_at' => Carbon::create('2026', '05', '04', '03', '51', '08'),
            ]
        ]);
    }
}
