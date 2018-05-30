<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\GradeCourt;
use App\User;
use Auth;

class GradesCourtController extends Controller
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

    public function grade(Request $request){

        $this->validate($request, [
            'court_id' => 'required',
            'grade' => 'required'
        ]);

        $res = GradeCourt::where(['user_id' => auth()->user()->id, 'court_id' => $request->input('court_id')])->get();
        

        if($res->count()){
            $gradecourt = GradeCourt::find($res->first()->id);  
        }
        else{
            $gradecourt = new GradeCourt();
            $gradecourt->court_id = $request->input('court_id');
            $gradecourt->user_id = auth()->user()->id;   
        }

        $gradecourt->grade = $request->input('grade');        
        $gradecourt->save();

        return response(1, 200);
    }

    public function reset(Request $request){

        GradeCourt::where(['user_id' => auth()->user()->id, 'court_id' => $request->input('court_id')])->get()->first()->delete();

        return response(1, 200);
    }
}
