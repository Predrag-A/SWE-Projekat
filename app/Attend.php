<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Attend extends Pivot
{
    protected $table='attends';
    public $timestamps=false;
}
