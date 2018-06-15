<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Attend;
use App\Event;

class AttendsController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::find($request->input('event'));
        if($event->isOver()){
            return redirect()->back()->with('error', 'Ne možete se pridružiti završenom događaju');
        }

        $attends = new Attend;
        $attends->user_id = auth()->user()->id;
        $attends->event_id = $request->input('event');
        $attends->save();

        return redirect()->back()->with('success', "Uspešno ste se pridružili događaju.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $attends = Attend::where(['user_id'=> auth()->user()->id, 'event_id' => $id]);

        $attends->delete();

        return redirect()->back()->with('success','Uspešno ste se odjavili od događaja.');
    }
}
