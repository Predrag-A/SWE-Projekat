<?php

namespace App\Traits;

use App\Sport;

trait SportTraits
{
  public function returnIcon() {
    switch($this->name) {
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