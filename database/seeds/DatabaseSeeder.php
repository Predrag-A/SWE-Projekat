<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(SportsTableSeeder::class);
        $this->call(CourtsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(RequestsTableSeeder::class);
        $this->call(AttendsTableSeeder::class);
        $this->call(FriendsTableSeeder::class);
        $this->call(CourtSportsTableSeeder::class);
        $this->call(GradeCourtsTableSeeder::class);
        $this->call(GradeUsersTableSeeder::class);
    }
}
