<?php

namespace App\Traits;

use App\Event;
use App\Attend;
use Carbon\Carbon;

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

  public function getTimeNoSeconds(){
    $str = explode(":", $this->getTime());
    return $str[0] . ":" . $str[1];
  }

  public function localizedDate(){
    $str = explode("-",$this->getDate());

    $months = array(
      "01" => 'Januar',
      "02" => 'Februar',
      "03" => 'Mart',
      "04" => 'April',
      "05" => 'Maj',
      "06" => 'Jun',
      "07" => 'Jul',
      "08" => 'Avgust',
      "09" => 'Septembar',
      "10" => 'Oktobar',
      "11" => 'Novembar',
      "12" => 'Decembar',     
    );

    return $str[2] . " " . $months[$str[1]] . " " . $str[0];
  }

  public function attendsCount(){
    return $this->attends()->get()->count();
  }

  public function isOver(){
    return Carbon::parse($this->time)->isPast();
  }

}