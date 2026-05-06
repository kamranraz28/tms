<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            TenantSeeder::class,
            TenantServiceSeeder::class,
            SettingsSeeder::class,
            ServicesSeeder::class,
            RolesSeeder::class,
            PermissionsSeeder::class,
            RoleHasPermissionsSeeder::class,
            PropertiesSeeder::class,
            ModelHasRolesSeeder::class,
            PaymentsSeeder::class,
            NotificationsSeeder::class,
            CostsSeeder::class,
            CostDetailsSeeder::class,
        ]);
    }
}
