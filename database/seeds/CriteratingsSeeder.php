<?php

use Illuminate\Database\Seeder;

class CriteratingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('criteratings')->insert(
            [
            'description' => 'Interdimensional Cable',
            'owner' => 1
            ]
        );
        DB::table('criteratings')->insert(
            [
            'description' => 'Fruits',
            'owner' => 1
            ]
        );
        DB::table('criteratings')->insert(
            [
            'description' => 'TV Shows',
            'owner' => 2
            ]
        );
    }
}
