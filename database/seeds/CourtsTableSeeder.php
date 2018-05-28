<?php

use Illuminate\Database\Seeder;

class CourtsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courts')->insert([
            ['location' => 'Dušan Radović, Đerdapska 45', 'city_id' => 1, 'lat' => 43.319638, 'long' => 21.931172],
            ['location' => 'Miroslav Antić, Knjaževačka 156', 'city_id' => 1, 'lat' => 43.328854, 'long' => 21.936165],            
            ['location' => 'Teniski tereni, Pariske Komune bb', 'city_id' => 1, 'lat' => 43.326089, 'long' => 21.899027],   
            ['location' => 'Svetozar Marković, Branka radičevića 1', 'city_id' => 1, 'lat' => 43.3120531, 'long' => 21.8856456],
            ['location' => 'SC Čair, 9. Brigade', 'city_id' => 1, 'lat' => 43.3146372, 'long' => 21.9080322],
        ]);
    }
}
