<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CourtImages;
use App\Traits\CourtTraits;

class Court extends Model
{
    use CourtTraits;
    
    protected $table='courts';
    public $timestamps=false;

    public function city(){
        return $this->belongsTo('App\City', 'city_id');
    }

    public function events(){        
        return $this->hasMany('App\Event','court_id');         
    }

    public function images(){
        return $this->hasMany('App\CourtImages','court_id');
    }

    public function sports(){
        $sports = array();

        $cs = CourtSport::where('court_id', $this->id)->get();

        foreach($cs as $sport):
            array_push($sports, \App\Sport::find($sport->sport_id));
        endforeach;

        return $sports;
    }

    public function grades(){
        return $this->belongsToMany('App\User','grade_courts','court_id','user_id')->withPivot('grade');
    }

}
