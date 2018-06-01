<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use DB;

class CityController extends Controller
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
    public function index()//vraca sve gradove i to se vidi kad se url-u doda /gradovi
    {
        return City::all();
        //$gradovi=Grad::all();
        //$gradovi=DB::select('SELECT * FROM grad');
        //moze $gradovi=Grad::order('naziv','asc')->get(); ako treba da se uredi
        //$grad=Grad::where('naziv','Nis')->get();
        //return view('gradovi.index')->with('gradovi',$gradovi);
        //$gradovi=Grad::order('naziv','asc')->paginate(1); jedan po strani, pa ima strelica za sledecu stranu
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //kada se url-u doda /gradovi/create pokrece se fja
    {
        //return view('gradovi.create'); pogled neki da vrati, uglavnom formu za kreiranje neceg
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //kad se klikne na submit poziva se
    {
        $this->validate($request, [
            'name'=>'required',
            'long'=>'required',
            'lat'=>'required',
            'zoom'=>'required',
        ]); //mora se popune ta polja u formi

        $city = new City();
        $city->name = $request->input('name');
        $city->lat = $request->input('lat');
        $city->long = $request->input('long');
        $city->zoom = $request->input('zoom');
        $city->save();

        //$grad->naziv=$request->input('ime txt boxa');
        //$grad->save(); cuva u bazi!!!!!!

        return $city;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//vraca grad sa id i to se vidi kad se url-u doda /gradovi/taj id
    {
        return City::find($id);
        //moze i kao kod index da se vrati neki view
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) //gradovi/neki id/edit
    {
        return City::find($id);//$grad
        //return view('gradovi.edit')->with('grad',$grad); opet neka forma za izmenu
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //action za forme za izmenu
    {
        $this->validate($request, [
            'naziv'=>'required',
            'sta god'=>'required'
        ]); //mora se popune ta polja u formi

        $grad=City::find($id);
        //$grad->naziv=$request->input('ime txt boxa');
        //$grad->save(); cuva u bazi!!!!!!

        return 2346;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) //brisanje ide preko forme, ne moze samo button jer se poziva ova fja @destroy
    {
        $grad=City::find($id);
        $grad->delete();
        return redirect('nesto da ucita, tipa index');
    }
}
