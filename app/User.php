<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $fillable = [
        'first_name', 'last_name', 'email', 'city', 'password', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'status'
    ];

    /**
     * Account Status
     */
    public function isAdmin(){
        return $this->where('status', 'Admin')->first();
    }

    public function isSuperAdmin(){
        return $this->where('status', 'SuperAdmin')->first();
    }


    public function isBanned(){
        return $this->where('status', 'Banned')->first();
    }
}
