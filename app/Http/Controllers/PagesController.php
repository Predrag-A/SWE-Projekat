<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\City;
use App\User;
use App\Notification;

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
    
    public function index(){
        if(Auth::check()){
            return view('pages.dashboard');
        }
        else{
        $cities = City::orderBy('name', 'asc')->get();
        return view('index')->with('cities', $cities);
        }
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

    public function dashboard(){  
        $cities = City::orderBy('name', 'asc')->get();
        return view('pages.dashboard')->with('cities', $cities);    
    }
    
    public function admin(){
        if(auth()->user()->isAdmin()){

            $users =  User::orderBy('first_name','asc')->where('id', '!=', auth()->user()->id)->paginate(20);
            return view('pages.admin')->with(['users' => $users]);
        }
        
        return redirect()->back()->with('error', 'Vaš nalog nema administratorske privilegije');
    }

    public function notifications(){

        $notifications =  Notification::orderBy('created_at','desc')->where('receiver_id', auth()->user()->id)->paginate(15);

        return view('pages.notifications')->with('notifications', $notifications);
    }
}
