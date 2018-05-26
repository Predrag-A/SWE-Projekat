<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\City;
use App\Attend;

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
        $events =  Event::orderBy('time','desc')->paginate(9);
        return view('pages.events.index')->with('events', $events);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $cities = City::orderBy('name', 'asc')->get();
        return view('pages.events.create')->with('cities', $cities);
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
        
        return redirect('/dogadjaji')->with('success', "Događaj kreiran!");

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

        return redirect('/dogadjaji')->with('success', "Događaj obrisan!");
    }
}
