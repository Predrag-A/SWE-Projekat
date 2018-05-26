<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\EventTraits;

class Event extends Model
{

    use EventTraits;

    protected $table='events';
    public $timestamps=false;

    public function court(){
        return $this->belongsTo('App\Court','court_id');
    }

    public function sport(){
        return $this->belongsTo('App\Sport','sport_id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment','event_id');
    }

    public function attends(){
        
        $users = array();

        $attends = Attend::where('event_id', $this->id)->get();

        foreach($attends as $user):
            array_push($users, \App\User::find($user->user_id));
        endforeach;

        return $users;
        
        // Opet nece ovo
        return $this->belongsToMany('App\User','attends','event_id','user_id');
    }
}
