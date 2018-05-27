<?php

namespace App\Traits;

use App\Event;
use App\Attend;

trait EventTraits
{

  // Vraca samo yyyy-mm-dd
  public function getDate(){    
    $str = explode(" ", $this->time);
    return $str[0];
  }

  // Vraca samo sate
  public function getTime(){    
    $str = explode(" ", $this->time);
    return $str[1];    
  }


}