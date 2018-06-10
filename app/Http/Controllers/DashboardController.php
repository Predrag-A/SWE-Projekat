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
    /*
     * Sprecava pristup korisnicima koji nisu prijavljeni. 
     * Ako nekom pogledu treba da se dozvoli pristup:
     * $this->middleware('auth', ['except' => ['index', 'show']]);
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
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
        $res = array();
        if($court){
            $events = $court->events()->get();
            foreach($events as $event){
                if(!$event->isOver()){
                    array_push($res, $event);
                }
            }            
        }
        
        return Response::make($res);  //moze i return ['data' => $data,];
    }

    public function getSports()  // .../web/api/sports
    {
        return Sport::all();
    }

    public function getEventAttends($eventid) // .../web/api/eventAttend/{eventid}
    {
        $event = Event::find($eventid);
        return Response::make($event->attendsCount());
    }
}
