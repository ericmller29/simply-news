<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['name', 'guid', 'source_id', 'image', 'summary'];
    protected $dates = ['published_date'];

    public function source(){
    	return $this->belongsTo('App\Source', 'source_id', 'id');
    }
}
