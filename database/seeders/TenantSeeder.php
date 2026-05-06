<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tenants')->insert([
            [
                'id' => 2,
                'property_id' => 2,
                'name' => 'Kamran',
                'phone' => '01609758377',
                'address' => 'Mymensingh',
                'nid_number' => '1234567896',
                'nid_upload' => null,
                'status' => 1,
                'invoicing' => 0,
                'invoice_month' => 0,
                'created_at' => '2025-05-25 03:31:52',
                'updated_at' => '2025-05-27 02:05:18',
            ],
        ]);
    }
}
