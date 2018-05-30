<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table='notifications';
    public $timestamps=true;
    
    protected $fillable = [
        'sender_id', 'receiver_id', 'title', 'body'
    ];
}
