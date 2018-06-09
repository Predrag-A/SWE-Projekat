<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourtImages extends Model
{
    protected $table='court_images';
    public $timestamps=false;

    protected $fillable = [
        'court_id', 'court_img'
    ];

    public function court(){
        return $this->belongsTo('App\Court','court_id');
    }
}
