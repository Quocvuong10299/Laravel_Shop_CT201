<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert(
            [
                'user_name' => 'test'.rand( 500, 1000),
                'user_email' =>  'test'.rand( 500, 1000000).'@gmail.com',
                'user_phone' =>'(+84)'.rand(5000, 10000000).'.'.rand(10000, 10000000),
                'password' => bcrypt('secret')
            ]
        );


    }
}
