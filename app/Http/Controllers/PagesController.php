<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\City;

class PagesController extends Controller
{
    public function index(){
        $cities = City::orderBy('name', 'asc')->get();
        return view('index')->with('cities', $cities);
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
        return view('pages.dashboard');
    }
}
