<?php

use Illuminate\Database\Seeder;

class UserCompanyProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_company_profile')->insert([
            'user_id' => 1,
            'company_id' => 1,
            'profile_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
        DB::table('user_company_profile')->insert([
            'user_id' => 1,
            'company_id' => 2,
            'profile_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
        DB::table('user_company_profile')->insert([
            'user_id' => 2,
            'company_id' => 1,
            'profile_id' => 2,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
        DB::table('user_company_profile')->insert([
            'user_id' => 2,
            'company_id' => 1,
            'profile_id' => 1,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
