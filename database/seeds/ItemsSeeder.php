<?php

use Illuminate\Database\Seeder;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('items')->insert(
            [
            'criterating_id' => 1,
            'description' => 'Smiggles',
            ]
        );
        DB::table('items')->insert(
            [
            'criterating_id' => 1,
            'description' => 'Man v Car',
            ]
        );
        DB::table('items')->insert(
            [
            'criterating_id' => 1,
            'description' => 'Two Brothers',
            ]
        );
        DB::table('items')->insert(
            [
            'criterating_id' => 2,
            'description' => 'Apple',
            ]
        );
        DB::table('items')->insert(
            [
            'criterating_id' => 1,
            'description' => 'Pear',
            ]
        );
    }
}
