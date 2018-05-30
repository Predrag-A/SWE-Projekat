<?php

use Illuminate\Database\Seeder;

class GradeCourtsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        factory(App\GradeCourt::class, 80)->create();
    }
}
