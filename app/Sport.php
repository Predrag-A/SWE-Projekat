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

    public function returnIcon($sportName) {
        switch($sportName) {
            case "Fudbal":
                return 'far fa-futbol fa-lg';
                break;
            case "Košarka":
                return 'fas fa-basketball-ball fa-lg';
                break; 
            case "Rukomet":
                return 'fas fa-futbol fa-lg';
                break;
            case "Tenis":
                return 'fas fa-table-tennis fa-lg';
                break;
            case "Futsal":
                return 'far fa-futbol fa-lg futsal';
                break;
            case "Odbojka":
                return 'fas fa-volleyball-ball fa-lg';
                break;
            default:
                return 'fas fa-question';
        }
    }
}
