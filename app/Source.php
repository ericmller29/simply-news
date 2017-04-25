<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $table = 'sources';
    protected $fillable = ['name', 'rss', 'logo'];

    public function users(){
    	return $this->belongsToMany('App\User', 'user_source', 'source_id', 'user_id');
    }

    public function articles(){
    	return $this->hasMany('App\Article', 'source_id', 'id');
    }
}
