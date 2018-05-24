<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
    public $timestamps=false;

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function event(){
        return $this->belongsTo('App\Event','event_id');
    }
}
