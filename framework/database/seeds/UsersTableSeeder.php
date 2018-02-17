<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Gummaro',
            'lastname' => 'Gonzalez',
            'email' => 'daeyeong@outlook.com',
            'password' => bcrypt('daeyeong_2017'),
            'departament_id' => 5,            
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);

    }
}
