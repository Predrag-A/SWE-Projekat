<?php

namespace App\Traits;

use App\User;
use App\Attend;

trait UserTraits
{
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



}