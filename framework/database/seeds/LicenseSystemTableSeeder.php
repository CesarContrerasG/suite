<?php

use Illuminate\Database\Seeder;

class LicenseSystemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('license_system')->insert([
            'license_id' => 1,
            'system_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
        DB::table('license_system')->insert([
            'license_id' => 2,
            'system_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
        DB::table('license_system')->insert([
            'license_id' => 3,
            'system_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
