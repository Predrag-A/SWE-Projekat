<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\City;

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
        $events =  Event::orderBy('time','desc')->paginate(10);
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
        //
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
        //
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

        $event->delete();
        return redirect('/dogadjaji')->with('success', "Događaj obrisan!");
    }
}
