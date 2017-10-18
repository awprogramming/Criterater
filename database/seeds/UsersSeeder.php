<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            [
                'name'=> 'Arie Wolf',
                'email'=> 'awprogramming@gmail.com',
                'password' => bcrypt('carling'),
            ]
        );
    }
}
