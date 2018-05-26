<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
    protected $table='courts';
    public $timestamps=false;

    public function city(){
        return $this->belongsTo('App\City', 'city_id');
    }

    public function events(){
        
        return $this->hasMany('App\Event','court_id');
        //Izmena
    }

    public function sports(){
        $sports = array();

        $cs = CourtSport::where('court_id', $this->id)->get();

        foreach($cs as $sport):
            array_push($sports, \App\Sport::find($sport->sport_id));
        endforeach;

        return $sports;
        /* Nece ovako
        return $this->belongsToMany('App\Sport','court_sports','sport_id','court_id');
        */
    }

    public function grades(){
        return $this->belongsToMany('App\User','grade_courts','court_id','user_id')->withPivot('grade');
    }
}
