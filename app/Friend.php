<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Friend extends Pivot
{
    protected $table='friends';
    public $timestamps=false;
}
