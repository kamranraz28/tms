<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TenantServiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('tenantservices')->insert([
            [
                'id' => 2,
                'tenant_id' => 2,
                'service_id' => 2,
                'value' => 1000,
                'status' => 1,
                'start_date' => null,
                'end_date' => null,
                'created_at' => '2025-05-25 04:01:11',
                'updated_at' => '2025-05-25 04:01:11',
            ],
            [
                'id' => 3,
                'tenant_id' => 2,
                'service_id' => 3,
                'value' => 20000,
                'status' => 1,
                'start_date' => null,
                'end_date' => null,
                'created_at' => '2025-05-25 04:05:41',
                'updated_at' => '2025-05-25 04:05:41',
            ],
            [
                'id' => 4,
                'tenant_id' => 2,
                'service_id' => 4,
                'value' => 500,
                'status' => 1,
                'start_date' => null,
                'end_date' => null,
                'created_at' => '2025-05-25 04:06:29',
                'updated_at' => '2025-05-25 04:06:29',
            ],
        ]);
    }
}
