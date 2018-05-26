<?php

use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sports')->insert([
            ['name' => 'Fudbal', 'color' => 'green'],
            ['name' => 'Košarka', 'color' => 'orangered'],
            ['name' => 'Rukomet', 'color' => 'blue'],
            ['name' => 'Tenis', 'color' => 'yellow'],            
            ['name' => 'Futsal', 'color' => 'green'],
            ['name'=>'Odbojka', 'color' => 'gray']
        ]);
    }
}
