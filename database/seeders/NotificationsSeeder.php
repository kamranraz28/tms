<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([
            [
                'id' => 4,
                'user_id' => null,
                'message' => 'Kajal created a perission- per_create',
                'is_read' => 0,
                'created_by' => 2,
                'created_at' => '2024-10-07 05:47:27',
                'updated_at' => '2025-02-16 02:31:29',
                'notifiable_type' => null,
                'notifiable_id' => 1,
            ],
            [
                'id' => 11,
                'user_id' => null,
                'message' => 'Kamran created a perission- notification_access',
                'is_read' => 0,
                'created_by' => 1,
                'created_at' => '2024-10-08 04:56:25',
                'updated_at' => '2025-02-16 02:31:29',
                'notifiable_type' => null,
                'notifiable_id' => 1,
            ],
            [
                'id' => 12,
                'user_id' => null,
                'message' => 'Kamran created a perission- user_configuration',
                'is_read' => 0,
                'created_by' => 1,
                'created_at' => '2024-10-08 05:06:37',
                'updated_at' => '2025-02-16 02:31:29',
                'notifiable_type' => null,
                'notifiable_id' => 1,
            ],
            [
                'id' => 13,
                'user_id' => null,
                'message' => 'Kamran created a perission- software_settings',
                'is_read' => 0,
                'created_by' => 1,
                'created_at' => '2024-10-15 03:03:25',
                'updated_at' => '2025-02-16 02:31:29',
                'notifiable_type' => null,
                'notifiable_id' => 1,
            ],
        ]);
    }
}
