<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['name', 'guid', 'source_id', 'image', 'summary'];

    public function source(){
    	return $this->belongsTo('App\Source', 'source_id', 'id');
    }
}
