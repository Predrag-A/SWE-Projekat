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
            ['name' => 'Fudbal', 'color' => 'green', 'image' => 'football.jpg'],
            ['name' => 'Košarka', 'color' => 'orange', 'image' => 'basketball.jpg'],
            ['name' => 'Rukomet', 'color' => 'blue', 'image' => 'handball.jpg'],
            ['name' => 'Tenis', 'color' => 'lime', 'image' => 'tennis.jpg'],            
            ['name' => 'Futsal', 'color' => 'grey', 'image' => 'futsal.jpg'],
            ['name'=>'Odbojka', 'color' => 'yellow', 'image' => 'volleyball.jpg']
        ]);
    }
}
