<?php

use Illuminate\Database\Seeder;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ratings')->insert(
            [
            'user_id' => 1,
            'item_id' => 1,
            'criterion_id'=> 1,
            'score' => 8,
            ]
        );
        DB::table('ratings')->insert(
            [
            'user_id' => 1,
            'item_id' => 1,
            'criterion_id'=> 2,
            'score' => 9,
            ]
        );
        DB::table('ratings')->insert(
            [
            'user_id' => 1,
            'item_id' => 1,
            'criterion_id'=> 3,
            'score' => 10,
            ]
        );
        DB::table('ratings')->insert(
            [
            'user_id' => 1,
            'item_id' => 2,
            'criterion_id'=> 1,
            'score' => 4,
            ]
        );
        DB::table('ratings')->insert(
            [
            'user_id' => 1,
            'item_id' => 2,
            'criterion_id'=> 2,
            'score' => 10,
            ]
        );
        DB::table('ratings')->insert(
            [
            'user_id' => 1,
            'item_id' => 2,
            'criterion_id'=> 3,
            'score' => 2,
            ]
        );
        DB::table('ratings')->insert(
            [
            'user_id' => 1,
            'item_id' => 3,
            'criterion_id'=> 1,
            'score' => 7,
            ]
        );
        DB::table('ratings')->insert(
            [
            'user_id' => 1,
            'item_id' => 3,
            'criterion_id'=> 2,
            'score' => 5,
            ]
        );
        DB::table('ratings')->insert(
            [
            'user_id' => 1,
            'item_id' => 3,
            'criterion_id'=> 3,
            'score' => 8,
            ]
        );
        
    }
}
