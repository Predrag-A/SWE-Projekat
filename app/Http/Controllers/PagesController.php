<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\City;
use App\User;
use App\Notification;
use App\Request;

class PagesController extends Controller
{

    /*
     * Sprecava pristup korisnicima koji nisu prijavljeni. 
     * Ako nekom pogledu treba da se dozvoli pristup:
     * $this->middleware('auth', ['except' => ['index', 'show']]);
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'about']]);
    }

    public function about(){
        if(Auth::check()){
            return view('pages.about');
        }
        else{
            $cities = City::orderBy('name', 'asc')->get();
            return view('pages.about')->with('cities', $cities);            
        }
    }

    public function index(){  
        $cities = City::orderBy('name', 'asc')->get();
        return view('index')->with('cities', $cities);    
    }

    public function dashboard(){  
        $cities = City::orderBy('name', 'asc')->get();
        return view('pages.dashboard')->with('cities', $cities);    
    }
    
    public function admin(){
        if(auth()->user()->isAdmin()){

            $requests =  Request::orderBy('created_at','desc')->paginate(15);            
            $cities = City::orderBy('name', 'asc')->get();
            return view('pages.admin')->with(['requests' => $requests, 'cities'=>$cities]);
        }
        
        return redirect()->back()->with('error', 'Vaš nalog nema administratorske privilegije');
    }

    public function notifications(){

        $notifications =  Notification::orderBy('created_at','desc')->where('receiver_id', auth()->user()->id)->paginate(15);

        return view('pages.notifications')->with('notifications', $notifications);
    }
}
