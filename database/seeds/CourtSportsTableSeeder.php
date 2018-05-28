<?php

use Illuminate\Database\Seeder;

class CourtSportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('court_sports')->insert([
            ['court_id' => 1, 'sport_id' => 1],
            ['court_id' => 1, 'sport_id' => 2],
            ['court_id' => 1, 'sport_id' => 4],
            ['court_id' => 1, 'sport_id' => 6], 

            ['court_id' => 2, 'sport_id' => 1],        
            ['court_id' => 2, 'sport_id' => 2],        
            ['court_id' => 2, 'sport_id' => 3],        
            ['court_id' => 2, 'sport_id' => 5],  

            ['court_id' => 3, 'sport_id' => 4],

            ['court_id' => 4, 'sport_id' => 2],        
            ['court_id' => 4, 'sport_id' => 4],     
            ['court_id' => 4, 'sport_id' => 5],

            
            ['court_id' => 5, 'sport_id' => 1],        
            ['court_id' => 5, 'sport_id' => 2],     
            ['court_id' => 5, 'sport_id' => 3],            
            ['court_id' => 5, 'sport_id' => 5],        
            ['court_id' => 5, 'sport_id' => 6], 
        ]);
    }
}
