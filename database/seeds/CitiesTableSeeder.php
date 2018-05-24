<?php

use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            ['name' => 'Niš', 'lat' => 43.320512, 'long' => 21.89569323, 'zoom' => 7.2],
            ['name' => 'Beograd', 'lat' => 44.78063269, 'long' => 20.45213493, 'zoom' => 7.2],
            ['name' => 'Novi Sad', 'lat' => 45.23969148, 'long' => 19.83964713, 'zoom' => 7.2],
            ['name' => 'Kragujevac', 'lat' => 44.00961504, 'long' => 20.91222655, 'zoom' => 7.2],
            ['name' => 'Subotica', 'lat' => 46.09654653, 'long' => 19.66495294, 'zoom' => 7.2],
            ['name' => 'Kruševac', 'lat' => 43.57508644, 'long' => 21.33852666, 'zoom' => 7.2],            
        ]);
    }
}
