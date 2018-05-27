<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';
    public $timestamps=true;

    protected $fillable = [
        'content',
        'user_id',
        'event_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    public function event(){
        return $this->belongsTo('App\Event','event_id');
    }
}
