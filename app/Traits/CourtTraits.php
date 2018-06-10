<?php

namespace App\Traits;

use App\Court;
use App\Sport;

trait CourtTraits
{  
    public function averageGrade(){
        $grades = $this->grades()->get();

        if($grades->count() == 0)
            return 0;
        $average = 0;
        $counter = 0;
        foreach($grades as $grade):
            $average += $grade->pivot->grade;
            $counter++;
        endforeach;
        $average /= $counter;
        return round($average, 2);
    }

    public function address(){
        $arr = explode(",", $this->location);
        return ltrim($arr[1]);
    }

    public function name(){
        $arr = explode(",", $this->location);
        return $arr[0];
    }    

    public function mainImage() {
        if($image = $this->images->first())
            return $image->court_img;
        return "default.jpg";
    }

    public function activeEvents(){
        $events = $this->events;
        $res = array();
        foreach($events as $event){
            if(!$event->isOver()){
                array_push($res, $event);
            }
        }
        return $res;
    }

    public function hasSport($name){
        if(in_array(Sport::where('name', $name)->first(), $this->sports())){
            return true;
        }
        return false;
    }
}