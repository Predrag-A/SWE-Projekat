<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\City;
use App\Notification;
use Auth;

class UserController extends Controller
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
        $users =  User::orderBy('first_name','asc')->where('id', '!=', auth()->user()->id)->paginate(20);
        return view('pages.users.index')->with('users', $users);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);              
        if($user){
            $cities = City::orderBy('name', 'asc')->get();
            return view('pages.users.show')->with(['user'=> $user, 'cities' => $cities]);
        }
        
        return redirect()->back()->with('error', 'Nepostojeći korisnik');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return redirect()->back();
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
            
        $user = User::find($id);
        

        // Hendlovanje izmene statusa, ako je status nema potrebe da se ide dalje
        if($request->input('status')){

            // Provera da li je status uopste izmenjen
            if($request->input('status') == $user->status){
                return redirect('/korisnici'. '/' . $user->id)->with('error', 'Status nije izmenjen');
            }

            $user->status = $request->input('status');
            $user->save();
            
            
            $notification = new Notification();
            $notification->sender_id = auth()->user()->id;
            $notification->receiver_id = $user->id;

            // Slanje odgovarajuce notifikacije u odnosu na promenjeni status
            if($request->input('status') == "Super-Admin"){
                
                auth()->user()->status = "Admin";
                auth()->user()->save();

                $notification->title = "Promena Statusa: Super-Admin";
                $notification->body = "Dobili ste status Super-Administratora.";
            }
            else if($request->input('status') == "Admin"){

                $notification->title = "Promena Statusa: Admin";
                $notification->body = "Dobili ste status Administratora.";
            }
            else if($request->input('status') == "Korisnik"){
                $notification->title = "Promena Statusa: Korisnik";
                $notification->body = "Dobili ste status Korisnika.";
            }
            else{
                $notification->title = "Promena Statusa: Suspendovani";
                $notification->body = "Nalog vam je suspendovan. Ne možete da kreirate događaje. RIP.";
            }
            
            $notification->save();
            
            return redirect('/korisnici'. '/' . $user->id)->with('success', 'Uspešna izmena statusa');

        }

        // Hendlovanje uploada
        if($request->hasFile('img')){

            $this->validate($request, [
                'img' => 'image|nullable|max:1999'
            ]);        
    

            // Uzimanje imena fajla sa ekstenzijom
            $fileNameWithExt = $request->file('img')->getClientOriginalName();
            // Samo ime fajla
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Samo ekstenzija
            $extension = $request->file('img')->getClientOriginalExtension();
            // Ime za cuvanje, ovako se radi zbog duplikata
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload slike
            $path = $request->file('img')->storePubliclyAs('public/avatars', $fileNameToStore);            
        }        

        if($request->input('first_name')){      
            $this->validate($request, [
                'first_name' => 'string|max:255'
            ]); 
            $user->first_name = $request->input('first_name');
        }

        
        if($request->input('last_name')){  

            $this->validate($request, [
                'last_name' => 'string|max:255'
            ]); 
            $user->last_name = $request->input('last_name');
        }

        
        if($request->input('email')){            
            $this->validate($request, [
                'email' => 'string|email|max:255|unique:users'
            ]);        
    
            $user->email = $request->input('email');
        }

        
        if($request->input('password')){  
            $this->validate($request,[                
            'password' => 'string|between:8,255|confirmed',
            ]);          
            $user->password = Hash::make($request->input('password'));
        }

        if($request->input('city_id')){   
            $this->validate($request, [
                'city_id' => 'integer',
            ]);                     
            $user->city_id = $request->input('city_id');
        }



        if($request->hasFile('img')){
            // Brisanje prethodne slike iz memorije
            if($user->user_img !== 'default.jpg'){
                Storage::delete('public/avatars/' . $user->user_img);
            }
            $user->user_img = $fileNameToStore;
        }

        $user->save();

        return redirect('/korisnici'. '/' . $user->id)->with('success', 'Uspešna izmena naloga!');
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

    public function search(){
                
        $query = Input::get('query');
        $city = City::where('name', 'like', '%'.$query.'%')->first();

        if($city){            
            $res = User::where('first_name', 'LIKE', '%'. strtolower($query) .'%')->orWhere('last_name', 'LIKE', '%'. $query. '%')->orWhere('city_id', $city->id);
        }
        else{            
            $res = User::where('first_name', 'LIKE', '%'. strtolower($query) .'%')->orWhere('last_name', 'LIKE', '%'. $query .'%');
        }
        
        $users = $res->where('id', '!=', auth()->user()->id)->orderBy('first_name','asc')->paginate(20);
        $users->appends(['query' => $query]);
        

        return view('pages.users.index')->with('users', $users);
    }
}
