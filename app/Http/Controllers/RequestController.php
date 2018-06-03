<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Request as RequestModel;
use App\Notification;

class RequestController extends Controller
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

    public function answer(Request $request){
        
        $this->validate($request, [
            'answer' => 'required',
            'user_id' => 'required',
            'request_id' => 'required',
            'request_title' => 'required',
            'request_body' => 'required',
        ]);

        $req = RequestModel::find($request->input('request_id'));

        if($req){
            $req->delete();
            $notification = new Notification();
            
            $notification->sender_id = auth()->user()->id;
            $notification->receiver_id = $request->input('user_id');
            $notification->title = "Odgovor: '".$request->input('request_title')."'";
            $notification->body = "<blockquote>".$request->input('request_body')."</blockquote><br>".$request->input('answer');
            $notification->save();

            return response(1, 200);
        }
        return response(0, 404);
        
    }
    
    public function send(Request $request){

        $this->validate($request, [
            'request' => 'required|max:255',
            'request_title' => 'required|max:25',
        ]);

        $req = new RequestModel();
        $req->title = $request->input('request_title');
        $req->text = $request->input('request');
        $req->user_id = auth()->user()->id;
        $req->save();

        return redirect()->back()->with('success', 'Vaša poruka je prosleđena administratorima');
    }
    
}
