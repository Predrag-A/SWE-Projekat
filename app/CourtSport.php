<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CourtSport extends Pivot
{
    protected $table='court_sports';
    public $timestamps=false;
}
