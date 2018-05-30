<?php

//use sve modele koji se koriste
namespace App\Http\Controllers;
use App\City;
use App\User;
use App\Event;
use App\Court;
use App\Sport;
use Illuminate\Http\Request;
use Response;

//Ovaj kontroler je za prosledjivanje podataka iz baze Vue.js-u
class DashboardController extends Controller 
{

    public function getUserCity() // .../web/api/usercity
    {
        $test = auth()->user()->city->name;
        $cities = City::where('name',$test)->get(); //->first() za vracanje jednog objeka, get vraca niz
        //$users = User::take(20)->get();
        return $cities;
    }

    public function getCities() // .../web/api/cities
    {
        return City::all();
    }

    public function getCityCourts($cityid) // .../web/api/citycourts/{cityid}
    {
        // Vraca sve terena u gradu sa id-jem option
        $city = City::find($cityid);
        $courts = $city->courts();
        return Response::make($courts->get(['id', 'location', 'lat', 'long']));
    }

    public function getCourtEvents($courtid) // .../web/api/courtEvents/{courtid}
    {
        $court = Court::find($courtid);
        $events = $court->events();
        return Response::make($events->get());
    }

    public function getSports()  // .../web/api/sports
    {
        return Sport::all();
    }
}
