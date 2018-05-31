<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
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

    public function read(Request $request){

        $this->validate($request, [
            'notification_id' => 'required'
        ]);        
        
        $notification = Notification::find($request->input('notification_id'));
        
        $notification->status = 1;

        $notification->save();

        return response(1, 200);

    }

    public function delete(Request $request){

        $this->validate($request, [
            'notification_id' => 'required'
        ]);        

        Notification::find($request->input('notification_id'))->delete();

        return response(1, 200);

    }

    public function user(Request $request){

        $this->validate($request, [
            'notification_id' => 'required'
        ]);     
        $notification = Notification::find($request->input('notification_id'));
        return User::find($notification->sender_id); 
    }

}
