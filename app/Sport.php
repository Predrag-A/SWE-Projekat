<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{    
    protected $table='sports';
    public $timestamps=false;

    public function events(){
        return $this->hasMany('App\Event','sport_id');
    }

    public function courts(){
        return $this->belongsToMany('App\Court','court_sports','sport_id','court_id');
    }
}
