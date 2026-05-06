<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'id' => 2,
                'name' => 'edit_post',
                'guard_name' => 'web',
                'created_at' => '2024-10-02 23:54:20',
                'updated_at' => '2024-10-02 23:54:20',
            ],
            [
                'id' => 3,
                'name' => 'delete_post',
                'guard_name' => 'web',
                'created_at' => '2024-10-02 23:54:29',
                'updated_at' => '2024-10-02 23:54:29',
            ],
            [
                'id' => 4,
                'name' => 'view_post',
                'guard_name' => 'web',
                'created_at' => '2024-10-03 03:07:48',
                'updated_at' => '2024-10-03 03:07:48',
            ],
            [
                'id' => 5,
                'name' => 'user_create',
                'guard_name' => 'web',
                'created_at' => '2024-10-03 05:38:05',
                'updated_at' => '2024-10-03 05:38:05',
            ],
            [
                'id' => 8,
                'name' => 'per_create',
                'guard_name' => 'web',
                'created_at' => '2024-10-07 05:47:27',
                'updated_at' => '2024-10-07 05:47:27',
            ],
            [
                'id' => 11,
                'name' => 'notification_access',
                'guard_name' => 'web',
                'created_at' => '2024-10-08 04:56:25',
                'updated_at' => '2024-10-08 04:56:25',
            ],
            [
                'id' => 12,
                'name' => 'user_configuration',
                'guard_name' => 'web',
                'created_at' => '2024-10-08 05:06:37',
                'updated_at' => '2024-10-08 05:06:37',
            ],
            [
                'id' => 13,
                'name' => 'software_settings',
                'guard_name' => 'web',
                'created_at' => '2024-10-15 03:03:25',
                'updated_at' => '2024-10-15 03:03:25',
            ],
        ]);
    }
}
