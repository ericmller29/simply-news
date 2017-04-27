<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Auth;
use App\Article;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sources(){
        return $this->belongsToMany('App\Source', 'user_source', 'user_id', 'source_id');
    }

    public static function articles($sourceId = null, $offset = null){
        return Article::where(function($query) use ($sourceId){
            $sources = collect(Auth::user()->sources);

            if(!$sourceId){
                $sources->each(function($item) use ($query){
                    $query->orWhere('source_id', $item->id);
                });
            }else{
                $query->where('source_id', $sourceId);
            }

        })->with(['source'])->when($offset, function($query) use ($offset){
            $query->offset($offset);
        })->limit(10)->orderBy('published_date', 'desc')->get();
    }
}
