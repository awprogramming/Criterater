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
            ]
        );
        DB::table('criteratings')->insert(
            [
            'description' => 'Fruits',
            ]
        );
        DB::table('criteratings')->insert(
            [
            'description' => 'TV Shows',
            ]
        );
    }
}
