<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'username' => 'ecode',
            'name' => 'E-CODE SA DE CV',
            'identif' => 'ECO160808J82',
            'contact' => str_random(10).'@gmail.com',
            'address' => 'ENFERMERIA DE CAPUCHINAS',
            'outdoor' => 107,
            'colony' => 'MARIANO DE LAS CASAS',
            'town' => 'QUERETARO',
            'state' => 'QUERETARO',
            'pcode' => '76037',
            'country' => 'MEX',
            'sector' => 1,
            'license_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
        DB::table('companies')->insert([
            'username' => 'etam',
            'name' => 'E-TAM SA DE CV',
            'identif' => 'ETA151201FL5',
            'contact' => str_random(10).'@gmail.com',
            'address' => 'ENFERMERIA DE CAPUCHINAS',
            'outdoor' => 107,
            'colony' => 'MARIANO DE LAS CASAS',
            'town' => 'QUERETARO',
            'state' => 'QUERETARO',
            'pcode' => '76037',
            'country' => 'MEX',
            'sector' => 1,
            'license_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);
    }
}
