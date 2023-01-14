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
       //以下を追加
       DB::table('users')->insert([
            'username' => 'test',//usernameはカラム名
            'mail' => 'test@test.com',//mailはカラム名
            'password' => bcrypt('5715'),//passwordはカラム名
       ]);

    }
}
