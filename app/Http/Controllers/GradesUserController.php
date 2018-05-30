<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GradeUser;

class GradesUserController extends Controller
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

    public function status($id){
        
        $res = GradeUser::where(['gradeduser_id' => $id, 'user_id' => auth()->user()->id])->get();
        
        if($res->count() == 0){            
            return [ "status" => "default" ];
        }

        $grade = $res->first();
        
        if($grade->grade == 1){
            return [ "status" => "like" ];
        }
        
        return [ "status" => "dislike" ];
    }
    
    public function like(Request $request){

        $this->validate($request, [
            'gradeduser_id' => 'required'
        ]);

        $res = GradeUser::where(['user_id' => auth()->user()->id, 'gradeduser_id' => $request->input('gradeduser_id')])->get();
        

        if($res->count()){
            $gradeuser = GradeUser::find($res->first()->id);  
        }
        else{
            $gradeuser = new GradeUser();
            $gradeuser->gradeduser_id = $request->input('gradeduser_id');
            $gradeuser->user_id = auth()->user()->id;   
        }
        
        $gradeuser->grade = 1;        
        $gradeuser->save();

        return response(1, 200);

    }

    public function dislike(Request $request){

        $this->validate($request, [
            'gradeduser_id' => 'required'
        ]);        

        $res = GradeUser::where(['user_id' => auth()->user()->id, 'gradeduser_id' => $request->input('gradeduser_id')])->get();
        
        if($res->count()){
            $gradeuser = GradeUser::find($res->first()->id);  
        }
        else{
            $gradeuser = new GradeUser();
            $gradeuser->gradeduser_id = $request->input('gradeduser_id');
            $gradeuser->user_id = auth()->user()->id;   
        }
        
        $gradeuser->grade = 0;        
        $gradeuser->save();

        return response(1, 200);

    }

    public function cancel(Request $request){

        $this->validate($request, [
            'gradeduser_id' => 'required'
        ]);        

        GradeUser::where(['user_id' => auth()->user()->id, 'gradeduser_id' => $request->input('gradeduser_id')])->get()->first()->delete();

        return response(1, 200);

    }
}
