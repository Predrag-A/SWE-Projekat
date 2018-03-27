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
            ['name' => 'Niš'],
            ['name' => 'Beograd'],
            ['name' => 'Novi Sad'],
            ['name' => 'Kragujevac'],
            ['name' => 'Subotica'],
            ['name' => 'Kruševac'],            
        ]);
    }
}
