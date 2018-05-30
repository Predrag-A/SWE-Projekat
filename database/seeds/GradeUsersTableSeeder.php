<?php

use Illuminate\Database\Seeder;

class GradeUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        factory(App\GradeUser::class, 300)->create();
    }
}
