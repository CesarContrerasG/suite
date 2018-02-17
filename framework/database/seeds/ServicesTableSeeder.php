<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            'name' => 'despacho',
            'message' => 'Una persona se ha interesado en servicio de despacho aduanero',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
        DB::table('services')->insert([
            'name' => 'transporte',
            'message' => 'Una persona se ha interesado en servicio de transporte',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
        DB::table('services')->insert([
            'name' => 'bodega',
            'message' => 'Una persona se ha interesado en servicio de bodega',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
