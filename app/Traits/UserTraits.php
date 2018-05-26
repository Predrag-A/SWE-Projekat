<?php

namespace App\Traits;

use App\User;
use App\Attend;

trait UserTraits
{

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