<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index(){
        return view('index');
    }

    public function about(){
        return view('pages.about');
    }

    public function dashboard(){
        return view('pages.dashboard');
    }
}
