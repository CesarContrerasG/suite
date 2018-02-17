<?php

use Illuminate\Database\Seeder;

class LicensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('licenses')->insert([
            'description' => 'VENTANET',
            'period' => 12,
            'tlicense_id' => 1
        ]);
        DB::table('licenses')->insert([
            'description' => 'VENTANET',
            'period' => 24,
            'tlicense_id' => 2
        ]);
        DB::table('licenses')->insert([
            'description' => 'SECENET',
            'period' => 12,
            'tlicense_id' => 1
        ]);
    }
}
