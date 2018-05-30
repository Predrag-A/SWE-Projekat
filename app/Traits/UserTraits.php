<?php

namespace App\Traits;

use App\User;
use App\GradeCourt;
use App\GradeUser;
use App\Attend;

trait UserTraits
{
   /**
     * Account Status
     */
    public function isAdmin(){
      return $this->status == 'Admin' || $this->status == 'Super-Admin';
  }

  public function isSuperAdmin(){
      return $this->status == 'Super-Admin';
  }

  public function isBanned(){
      return $this->status == 'Suspendovan';
  }

  // Proverava da li user prisustvuje dogadjaju sa idjem $eventId
  public function isAttending($eventId){
    
    $events = $this->attends();

    if(empty($events))
      return false;
    
    $eventIds = array();

    foreach($events as $event):
      array_push($eventIds, $event->id);
    endforeach;
    
    if(in_array($eventId, $eventIds)){
      return 1;
    }
    else{
      return 0;
    }
    
  }

  // Vraca ocenu koju je dao terenu sa id-jem $courtId
  public function courtRating($courtId){

    $res = GradeCourt::where(['user_id' => $this->id, 'court_id' => $courtId])->get();

    if($res->count()){
      return $res->first()->grade;
    }
    return 0;

  }

  public function likeCount(){
    $res = GradeUser::where(['gradeduser_id' => $this->id, 'grade' => 1])->get();

    return $res->count();
  }

  public function dislikeCount(){
    
    $res = GradeUser::where(['gradeduser_id' => $this->id, 'grade' => 0])->get();

    return $res->count();
  }
}