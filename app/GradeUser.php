<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class GradeUser extends Pivot
{
    protected $table='grade_users';
    public $timestamps=false;
}
