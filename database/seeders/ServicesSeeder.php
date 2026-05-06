<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'id'             => 2,
                'name'           => 'Electricity Bill',
                'description'    => 'Monthly electricity bill associated with tenant rent',
                'status'         => 1,
                'created_at'     => '2025-05-25 01:55:20',
                'updated_at'     => '2025-05-25 01:55:24',
            ],
            [
                'id'             => 3,
                'name'           => 'Rent',
                'description'    => 'Monthly rental charge for tenant accommodation',
                'status'         => 1,
                'created_at'     => '2025-05-25 04:05:27',
                'updated_at'     => '2025-05-25 04:05:27',
            ],
            [
                'id'             => 4,
                'name'           => 'Parking',
                'description'    => 'Monthly parking space charge for vehicles',
                'status'         => 1,
                'created_at'     => '2025-05-25 04:05:54',
                'updated_at'     => '2025-05-25 04:06:09',
            ],
            [
                'id'             => 5,
                'name'           => 'Water Bill',
                'description'    => 'Monthly water usage charge for tenant',
                'status'         => 1,
                'created_at'     => '2025-05-25 04:05:54',
                'updated_at'     => '2025-05-25 04:06:09',
            ],
            [
                'id'             => 6,
                'name'           => 'Water Bill',
                'description'    => 'Monthly water usage charge for tenant',
                'status'         => 1,
                'created_at'     => '2025-05-25 04:05:54',
                'updated_at'     => '2025-05-25 04:06:09',
            ],
            [
                'id'             => 7,
                'name'           => 'Internet Service',
                'description'    => 'Monthly internet connection fee for tenant use',
                'status'         => 1,
                'created_at'     => '2025-05-25 04:05:54',
                'updated_at'     => '2025-05-25 04:06:09',
            ],
            [
                'id'             => 8,
                'name'           => 'Maintenance Fee',
                'description'    => 'Building maintenance and repair service charge',
                'status'         => 1,
                'created_at'     => '2025-05-25 04:05:54',
                'updated_at'     => '2025-05-25 04:06:09',
            ],
            [
                'id'             => 9,
                'name'           => 'Security Fee',
                'description'    => 'Security service charge for tenant safety',
                'status'         => 1,
                'created_at'     => '2025-05-25 04:05:54',
                'updated_at'     => '2025-05-25 04:06:09',
            ],
            [
                'id'             => 10,
                'name'           => 'Cleaning Service',
                'description'    => 'Common area cleaning and sanitation charge',
                'status'         => 1,
                'created_at'     => '2025-05-25 04:05:54',
                'updated_at'     => '2025-05-25 04:06:09',
            ],

        ]);
    }
}
