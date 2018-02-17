<?php

use Illuminate\Database\Seeder;

class SystemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('systems')->insert([
            'name' => 'SECENET',
            'description' => 'Sistema Empresarial de Comercio Exterior',
            'date' => date('Y-m-d'),
            'version' => 1.0,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('systems')->insert([
            'name' => 'VENTANET',
            'description' => 'Software Empresarial para Ventanilla Unica',
            'date' => date('Y-m-d'),
            'version' => 1.0,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
    }
}
