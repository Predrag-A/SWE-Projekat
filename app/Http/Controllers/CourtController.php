<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Court;
use App\CourtSport;

class CourtController extends Controller
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
        $courts = Court::all();
        return view('pages.courts.index')->with('courts', $courts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //$city->naziv=$request->input('ime txt boxa');
        //$city->save(); cuva u bazi!!!!!!
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
            'location'=>'required',
            'city_id'=>'required',
            'lat'=>'required',
            'long'=>'required',
        ]); //mora se popune ta polja u formi

        $court = new Court();
        $court->location = $request->input('location');
        $court->lat = $request->input('lat');
        $court->long = $request->input('long');
        $court->city_id = $request->input('city_id');
        $court->save();

        // Nije htelo drugacije, cu pogledam posle
        if($request->input('football')){            
            $cs1 = new CourtSport();
            $cs1->court_id = $court->id;
            $cs1->sport_id = 1;
            $cs1->save();
        }
        if($request->input('basketball')){
            $cs2 = new CourtSport();
            $cs2->court_id = $court->id;
            $cs2->sport_id = 2;
            $cs2->save();
        }
        if($request->input('handball')){
            $cs3 = new CourtSport();
            $cs3->court_id = $court->id;
            $cs3->sport_id = 3;
            $cs3->save();
        }
        if($request->input('tennis')){
            $cs4 = new CourtSport();
            $cs4->court_id = $court->id;
            $cs4->sport_id = 4;
            $cs4->save();
        }
        if($request->input('futsal')){
            $cs5 = new CourtSport();
            $cs5->court_id = $court->id;
            $cs5->sport_id = 5;
            $cs5->save();
        }
        if($request->input('volleyball')){
            $cs6 = new CourtSport();
            $cs6->court_id = $court->id;
            $cs6->sport_id = 6;
            $cs6->save();
        }

        return response(1, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $court = Court::find($id);
        return view('pages.courts.show')->with(['court'=>$court]);
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
        //
    }
}
