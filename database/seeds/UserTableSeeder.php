<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table("users")->insert([
            "name" => 'testuser',
            "email" => 'testuser@hoge.com',
            "password" => bcrypt('secret'),
            "remember_token" => null
        ]);
    }
}
