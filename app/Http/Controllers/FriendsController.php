<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Friend;
use Illuminate\Http\Request;

class FriendsController extends Controller
{      
    
    public function check($id)
    {        
        if(Auth::user()->is_friends_with($id) === 1)
        {
            return [ "status" => "friends" ];
        }
        
        if(Auth::user()->has_pending_friend_request_from($id))
        {            
            return [ "status" => "pending" ];
        }
        if(Auth::user()->has_pending_friend_request_sent_to($id))
        {
            return [ "status" => "waiting" ];
        }
        return [ "status" => 0 ];
    }

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
