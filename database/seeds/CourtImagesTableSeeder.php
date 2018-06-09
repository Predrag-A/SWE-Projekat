<?php

use Illuminate\Database\Seeder;

class CourtImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('court_images')->insert([
            ['court_id' => 1, 'court_img' => "Teren1Slika1.jpg"],
            ['court_id' => 1, 'court_img' => "Teren1Slika2.jpg"],
            ['court_id' => 1, 'court_img' => "Teren1Slika3.jpg"],
            ['court_id' => 1, 'court_img' => "Teren1Slika4.jpg"],

            ['court_id' => 2, 'court_img' => "Teren2Slika1.jpg"], 
            ['court_id' => 2, 'court_img' => "Teren2Slika2.jpg"],  
            ['court_id' => 2, 'court_img' => "Teren2Slika3.jpg"],  
        ]);
    }
}
