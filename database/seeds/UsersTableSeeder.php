<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {       

        //Dodavanje test naloga
        DB::table('users')->insert([
            // Super-admin nalog
            ['first_name' => 'Admin',
            'last_name' => 'Super_Admin',
            'email' => 'sadmin@test.com',
            'city_id' => '1',
            'password' => Hash::make('admin'),
            'jmbg' => '0000000000000',
            'status' => 'Super-Admin'],
            // Obican admin nalog
            ['first_name' => 'Admin',
            'last_name' => 'Obican_Admin',
            'email' => 'admin@test.com',
            'city_id' => '1',
            'password' => Hash::make('admin'),
            'jmbg' => '0000000000001',
            'status' => 'Admin'],
            // Suspendovani korisnik nalog
            ['first_name' => 'Suspendovani',
            'last_name' => 'Korisnik',
            'email' => 'suspendovani@test.com',
            'city_id' => '1',
            'password' => Hash::make('admin'),
            'jmbg' => '0000000000002',
            'status' => 'Suspendovan']              
        ]);

        //Dodavanje korisnika
        factory(App\User::class, 100)->create();
    }
}
