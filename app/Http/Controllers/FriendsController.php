<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Friend;
use App\Notification;
use Illuminate\Http\Request;

class FriendsController extends Controller
{      
        
    public function add(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $resp = auth()->user()->add_friend($request->input('user_id'));       

        return response($resp, 200);
        
    }

    public function accept(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $resp = auth()->user()->accept_friend($request->input('user_id'));       
        
        // Notifikacija
        $notification = new Notification();
        $notification->sender_id = auth()->user()->id;
        $notification->receiver_id = $request->input('user_id');
        $notification->title = "Prihvaćen Zahtev Za Prijatelja";
        $notification->body = "Korisnik je prihvatio vaš zahtev za prijateljstvo. Možete pregledati događaje koje je na stranici njihovog profila.";
        $notification->save();

        return response($resp, 200);
        
    }

    public function delete(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        
        // Ako korisnik koji je poslao zahtev brise prijateljstvo
        $res = Friend::where('requester', auth()->user()->id)->where('user_requested', $request->input('user_id'))->get();
        
        if($res->count()){
            $res->first()->delete();
        }

        
        // Ako korisnik koji je prihvatio zahtev brise prijateljstvo
        $res = Friend::where('user_requested', auth()->user()->id)->where('requester', $request->input('user_id'))->get();
        
        if($res->count())
            $res->first()->delete();

        return response(1, 200);
        
    }
}
