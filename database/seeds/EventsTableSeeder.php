<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('events')->insert([            
            ['time' => '2018-07-01 18:00:00', 'user_id' => 1, 'sport_id' => 1, 'court_id' => 5],
            ['time' => '2018-07-02 19:00:00', 'user_id' => 2, 'sport_id' => 2, 'court_id' => 4],
            ['time' => '2018-07-01 17:00:00', 'user_id' => 1, 'sport_id' => 3, 'court_id' => 2],
            ['time' => '2018-07-01 15:00:00', 'user_id' => 2, 'sport_id' => 4, 'court_id' => 3],
            ['time' => '2018-07-03 09:30:00', 'user_id' => 2, 'sport_id' => 5, 'court_id' => 2],
            ['time' => '2018-07-05 16:45:00', 'user_id' => 1, 'sport_id' => 6, 'court_id' => 1],
            ['time' => '2018-07-03 15:00:00', 'user_id' => 1, 'sport_id' => 2, 'court_id' => 4],
            ['time' => '2018-07-02 17:00:00', 'user_id' => 1, 'sport_id' => 1, 'court_id' => 2],
            ['time' => '2018-07-04 15:00:00', 'user_id' => 2, 'sport_id' => 5, 'court_id' => 2],
        ]);
    }
}
