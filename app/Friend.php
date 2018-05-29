<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Friend extends Pivot
{
    protected $table='friends';
    public $timestamps=false;

    protected $fillable = ['requester', 'user_requested', 'status'];
}
