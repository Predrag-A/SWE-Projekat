<?php

//use sve modele koji se koriste
namespace App\Http\Controllers;
use App\City;
use App\User;
use Illuminate\Http\Request;

//Ovaj kontroler je za prosledjivanje podataka iz baze Vue.js-u
class DashboardController extends Controller 
{

    public function getCities()
    {
        $cities = City::where('name','Beograd')->get(); //->first() za vracanje jednog objeka, get vraca niz
        //$users = User::take(20)->get();
        return $cities;
    }
}
