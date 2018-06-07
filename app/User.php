<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\UserTraits;
use App\Traits\Friendable;

class User extends Authenticatable
{
    use Notifiable;
    use UserTraits;
    use Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'first_name', 'last_name', 'city_id', 'email', 'password', 'jmbg', 'user_img','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * City
     */
    public function city(){
        return $this->belongsTo('App\City','city_id');
    }

    public function events(){
        return $this->hasMany('App\Event','user_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment','user_id');
    }

    public function requests(){
        return $this->hasMany('App\Request','user_id');
    }

    public function attends(){     

        $events = array();

        $attends = Attend::where('user_id', $this->id)->get();

        foreach($attends as $event):
            array_push($events, \App\Event::find($event->event_id));
        endforeach;

        return $events;
        
        //Nece nesto ovako
        //return $this->belongsToMany('App\Event','attends','user_id','event_id');
    }

    // Morao sam da izbacim zato sto ne uzima u obzir status
    /*
    public function friends(){
        
        return $this->belongsToMany('App\User','friends','requester','user_requested');
    }

    public function friendto(){
        return $this->belongsToMany('App\User','friends','user_requested','requester');
    }*/

    public function gradescourt(){
        return $this->belongsToMany('App\Court','grade_courts','user_id','court_id')->withPivot('grade');
    }

    public function gradesuser(){
        return $this->belongsToMany('App\User','grade_users','user_id','gradeduser_id')->withPivot('grade');
    }

    public function gradeduser(){
        return $this->belongsToMany('App\User','grade_users','gradeduser_id','user_id')->withPivot('grade');
    }

    public function notifications(){        
        return $this->hasMany('App\Notification','receiver_id');
    }

}
