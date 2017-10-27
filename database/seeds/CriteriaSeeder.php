<?php

use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('criteria')->insert(
            [
            'criterating_id' => 1,
            'description' => 'Hilarity',
            'weight' => 60,
            ]
        );
        DB::table('criteria')->insert(
            [
            'criterating_id' => 1,
            'description' => 'Callbacks',
            'weight' => 10,
            ]
        );
        DB::table('criteria')->insert(
            [
            'criterating_id' => 1,
            'description' => 'Improv',
            'weight' => 30,
            ]
        );
        
    }
}
