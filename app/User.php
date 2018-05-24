<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'first_name', 'last_name', 'city_id', 'email', 'password', 'jmbg'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'status', 'jmbg'
    ];

    /**
     * Account Status
     */
    public function isAdmin(){
        return $this->where('status', 'Admin')->first();
    }

    public function isSuperAdmin(){
        return $this->where('status', 'Super-Admin')->first();
    }

    public function isBanned(){
        return $this->where('status', 'Suspendovan')->first();
    }

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
        return $this->belongsToMany('App\Event','attends','user_id','event_id');
    }

    public function friends(){
        return $this->belongsToMany('App\User','friends','user_id','friend_id');
    }

    public function friendto(){
        return $this->belongsToMany('App\User','friends','friend_id','user_id');
    }

    public function gradescourt(){
        return $this->belongsToMany('App\Court','grade_courts','user_id','court_id')->withPivot('grade');
    }

    public function gradesuser(){
        return $this->belongsToMany('App\User','grade_users','user_id','gradeduser_id')->withPivot('grade');
    }

    public function gradeduser(){
        return $this->belongsToMany('App\User','grade_users','gradeduser_id','user_id')->withPivot('grade');
    }

}
