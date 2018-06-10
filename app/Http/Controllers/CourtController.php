<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\Court;
use App\CourtSport;
use App\City;
use App\CourtImages;
use App\User;
use App\Notification;

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
        $courts = Court::orderBy('location','desc')->paginate(12);
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
        $court->description = "";        
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

        $users = User::where('city_id', $request->input('city_id'))->get();
        $city = City::find($court->city_id);
        
        foreach($users as $user){            
            if($user->id != auth()->user()->id){
                Notification::create([
                    'sender_id' => auth()->user()->id,
                    'receiver_id' => $user->id,
                    'title' => "Novi teren u gradu!",
                    'body' => "Na osnovu zahteva korisnika dodali smo nov teren u vašem gradu. Detaljima o terenu možete pristupiti preko linka ispod ili direktno preko mape sa početne strane.
                    <div class='col s12 m6 l4 offset-m3 offset-l4'>
                        <div class='card col-content z-depth-3'>                        
                    
                            <div class='card-content'>
                                <span class='card-title'>" .$court->name() . "</span>
                                <span>". $court->address().", ". $city->name ."</span>
                            </div>

                            <div class='card-action center'>
                                <a href='/tereni/" . $court->id . " class='card-title'>Detalji</a>
                            </div>                                    
                        </div>      
                    </div>
                    ",
                    
                ]);
            }
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
        if($court)
            return view('pages.courts.show')->with(['court'=>$court]);
        
        return redirect()->back()->with('error', 'Nepostojeći teren');
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
        
        $this->validate($request, [            
            'images.*' => 'image|nullable|max:1999',            
            'location'=>'string',
            'opis' => 'string'
        ]);
        $court = Court::find($id);
        $count = count($court->images);

        if($request->images){
            foreach($request->images as $image){
                // Provera za max broj slika
                if($count > 5){
                    break;
                }
                // Uzimanje imena fajla sa ekstenzijom
                $fileNameWithExt = $image->getClientOriginalName();
                // Samo ime fajla
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                // Samo ekstenzija
                $extension = $image->getClientOriginalExtension();
                // Ime za cuvanje, ovako se radi zbog duplikata
                $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
                // Upload slike
                $path = $image->storeAs('public/tereni', $fileNameToStore);

                CourtImages::create([
                    'court_id' => $court->id,
                    'court_img' => $fileNameToStore
                ]);                  
                $count++;
            }
        }

        $court->description = $request->input('opis');
        $court->location = $request->input('location');
        $court->save();

        $cs = CourtSport::where('court_id', $id);
        if($cs){
            $cs->delete();
        }

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
        
        return redirect()->back()->with('success', 'Teren je ažuriran');

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

    public function search(Request $request)
    {
        $query = Input::get('query');
        
        $city = City::where('name', 'like', '%'.$query.'%')->first();

        if($city){            
            $res = Court::where('location', 'LIKE', '%'. strtolower($query) .'%')->orWhere('city_id', $city->id);
        }
        else{            
            $res = Court::where('location', 'LIKE', '%'. strtolower($query) .'%');
        }
        
        $courts = $res->orderBy('location','desc')->paginate(12);
        $courts->appends(['query' => $query]);

        return view('pages.courts.index')->with('courts', $courts);
    }

    public function sports($id){

        $court = Court::find($id);        
        $sports = $court->sports();
        return response($sports, 200);
    }

    public function deleteImage(Request $request){

        $this->validate($request, [
            'image_id' => 'integer'
        ]);  

        $image = CourtImages::find($request->input('image_id'));

        if($image){            
            Storage::delete('public/tereni/' . $image->court_img);
            $image->delete();
        }

        return redirect()->back()->with('success', 'Slika je obrisana');

    }
}
