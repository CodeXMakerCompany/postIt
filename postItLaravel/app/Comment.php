<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    
    //Relacion de Many a One
    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }

    //Relacion de Many a One
    public function image() {
    	return $this->belongsTo('App\Image', 'image_id');
    }
}
