<?php

use Illuminate\Database\Seeder;

class ProspectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prospects')->insert([
            'name' => 'Ana',
            'email' => str_random(10).'@gmail.com',
            'phone' => '44256586',
            'type' => 1,
            'webpage' => 'etam',
            'service_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
        DB::table('prospects')->insert([
            'name' => 'Cristofer',
            'email' => str_random(10).'@gmail.com',
            'phone' => '442559722',
            'type' => 1,
            'webpage' => 'secenet',
            'service_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
        DB::table('prospects')->insert([
            'name' => 'Veronica',
            'phone' => '4428952455',
            'email' => str_random(10).'@gmail.com',
            'type' => 2,
            'webpage' => 'etam',
            'service_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
