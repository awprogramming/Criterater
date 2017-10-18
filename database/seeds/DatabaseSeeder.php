<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(CriteratingsSeeder::class);
        $this->call(UsersSeeder::class);
    }
}
