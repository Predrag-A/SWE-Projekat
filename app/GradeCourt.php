<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GradeCourt extends Pivot
{
    protected $table='grade_courts';
    public $timestamps=false;
}
