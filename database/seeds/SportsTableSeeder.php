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
            ['name' => 'Fudbal'],
            ['name' => 'Košarka'],
            ['name' => 'Rukomet'],
            ['name' => 'Tenis'],            
            ['name' => 'Futsal'],
            ['name'=>'Odbojka']
        ]);
    }
}
