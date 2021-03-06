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
        DB::table("users")->insert([
            "name" => 'testuser2',
            "email" => 'testuser2@hoge.com',
            "password" => bcrypt('secret'),
            "remember_token" => null
        ]);
        DB::table("users")->insert([
            "name" => 'testuser3',
            "email" => 'testuser3@hoge.com',
            "password" => bcrypt('secret'),
            "remember_token" => null
        ]);
    }
}
