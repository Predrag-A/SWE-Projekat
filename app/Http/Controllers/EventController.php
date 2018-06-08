<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\City;
use App\Attend;
use App\Sport;
use App\Court;
use App\Notification;
use Auth;

class EventController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {                
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required',
            'time' => 'required',
            'city' => 'required',
            'court' => 'required',
            'sport' => 'required'
        ]);

        $time = $request->input('date') . " " . $request->input('time');

        $event = new Event;
        $event->user_id = auth()->user()->id;
        $event->sport_id = $request->input('sport');
        $event->court_id = $request->input('court');
        $event->time = $time;

        $event->save();

        $attends = new Attend;
        $attends->user_id = auth()->user()->id;
        $attends->event_id = $event->id;
        $attends->save();
        
        if($request->input('friends')){

            $sport = Sport::find($event->sport_id);
            $court = Court::find($event->court_id);

            foreach(auth()->user()->friends_ids() as $user){

                $notification = new Notification();
                $notification->sender_id = auth()->user()->id;
                $notification->receiver_id = $user;
                $notification->title = "Poziv Na Događaj";
                $notification->body = "Korisnik vas je pozvao da prisustvujete događaju koji je upravo kreirao. Link do događaja možete naći ispod." . "<br>" .
                "<div class='col s12 m6 l4 offset-m3 offset-l4'>
                    <div class='card medium col-content z-depth-3' style='border: 1px solid".$sport->color."'>                    
                        <div class='card-image'>
                            <img src='/img/" . $sport->image . "'>
                            <span class='card-title'>" . $event->localizedDate() . ", " . $event->getTimeNoSeconds() . "</span>
                        </div>

                        <div class='card-action center'>
                            <a href='/dogadjaji/" . $event->id . "' class='card-title " . $sport->color . "-text'>Detalji</a>
                        </div>
                        
                        <div class='card-content'>
                            <span class='card-title " . $sport->color ."-text'>Kreirao:</span>
                            <a href='/korisnici/".auth()->user()->id."' class='black-text'>".auth()->user()->first_name." ".auth()->user()->last_name."</a>   
                            <star-rating></star-rating>    
                        </div>                        
                    </div>      
                </div>";
                $notification->save();
            }
        }

        return redirect('/dogadjaji'. '/' . $event->id)->with('success', "Događaj kreiran!");

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {        
        $event = Event::find($id);
        return view('pages.events.show')->with('event', $event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //U slucaju da neko pokusa preko direktnog linka da izvrsi izmenu

        $event = Event::find($id);

        if(auth()->user()->id != $event->user_id){

            return redirect()->back()->with('error', 'Nije moguće izmeniti tuđi događaj!');
        }

        $cities = City::all();

        return view('pages.events.edit')->with(['event'=> $event, 'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'date' => 'required',
            'time' => 'required',
            'city' => 'required',
            'court' => 'required',
            'sport' => 'required'
        ]);
        
        
        $event = Event::find($id);

        $time = $request->input('date') . " " . $request->input('time');

        $event->sport_id = $request->input('sport');
        $event->court_id = $request->input('court');
        $event->time = $time;

        $event->save();

        return redirect('/dogadjaji'. '/' . $event->id)->with('success', 'Uspešna izmena događaja!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if(auth()->user()->id != $event->user_id){
            return redirect()->back()->with('error', 'Nije moguce pristupiti stranici.');
        }

        Attend::where('event_id', $id)->delete();

        $event->delete();

        return redirect('/dashboard')->with('success', "Događaj obrisan!");
    }
}
