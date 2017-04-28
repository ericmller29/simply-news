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

    public static function guest($id = null, $offset = null){
    	return Article::with(['source'])->whereHas('source', function($query){
    		$query->where('sources.local', 0);
    	})->when($id, function($query) use ($id){
    		$query->where('source_id', $id);
    	})->when($offset, function($query) use ($offset){
    		$query->offset($offset);
    	})->limit(10)->orderBy('published_date', 'desc')->get();
    }
}
