<?php

//use sve modele koji se koriste
namespace App\Http\Controllers;
use App\City;
use App\User;
use Illuminate\Http\Request;

//Ovaj kontroler je za prosledjivanje podataka iz baze Vue.js-u
class DashboardController extends Controller 
{

    public function getUserCity()
    {
        $test = auth()->user()->city->name;
        $cities = City::where('name',$test)->get(); //->first() za vracanje jednog objeka, get vraca niz
        //$users = User::take(20)->get();
        return $cities;
    }

    public function getCities()
    {
        return City::all();
    }
}
