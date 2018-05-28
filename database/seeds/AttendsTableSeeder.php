<?php

use Illuminate\Database\Seeder;

class AttendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {     
        DB::table('attends')->insert([            
            ['user_id' => 1, 'event_id' => 1], 
            ['user_id' => 2, 'event_id' => 2],             
            ['user_id' => 1, 'event_id' => 3], 
            ['user_id' => 2, 'event_id' => 4], 
            ['user_id' => 2, 'event_id' => 5], 
            ['user_id' => 1, 'event_id' => 6], 
            ['user_id' => 1, 'event_id' => 7], 
            ['user_id' => 1, 'event_id' => 8], 
            ['user_id' => 2, 'event_id' => 9],
        ]);

        factory(App\Attend::class, 30)->create();
    }
}
