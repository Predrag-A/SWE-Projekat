<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        //Dodavanje korisnika
        factory(App\Comment::class, 100)->create();
    }
}
