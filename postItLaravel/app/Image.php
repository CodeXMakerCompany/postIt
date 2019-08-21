<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //Que tabla de la bd estare interactuando
    protected $table = 'image';

    //Relacion One to Many Comments
    public function comments() {
    	return $this->hasMany('App\Comment');
    }

    //Relacion One to Many Likes
    public function likes() {
    	return $this->hasMany('App\Like');
    }

    //Relacion de Many a One
    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }

}
