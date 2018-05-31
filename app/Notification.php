<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table='notifications';
    public $timestamps=true;
    
    protected $fillable = [
        'sender_id', 'receiver_id', 'title', 'body', 'status'
    ];

    public function sender(){
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function receiver(){
        return $this->belongsTo('App\User', 'receiver_id');
    }
}
