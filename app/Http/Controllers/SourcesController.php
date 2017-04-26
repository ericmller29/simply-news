<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Source;
use App\News\Parser;

use Auth;

use DivineOmega\PHPSummary;

class SourcesController extends Controller
{
	protected $parse;

    public function __construct(){
    	$this->middleware('auth');
    	$this->parse = new Parser();
    }

    public function index(){
    	return view('sources.list');
    }

    public function addSource(){
    	return view('sources.add');
    }

    public function post_addSource(Request $request){
    	$feed = $this->parse->feed($request->get('rss'));

    	$validate = Validator::make($request->all(), [
    		'rss' => 'required'
    	]);

    	if($validate->fails()){
    		return redirect('/sources/add')
                        ->withErrors($validate)
                        ->withInput();
    	}
    	if($feed->error()){
    		return redirect('/sources/add')->withErrors([
    			'rss' => 'Not a valid rss feed!'
    		])->withInput();
    	}

    	if(Auth::user()->sources->where('name', $feed->get_title())->first()){
    		return redirect('/sources/add')->withErrors([
    			'rss' => 'You already have this source!'
    		])->withInput();
    	}

    	if(!$source = Source::where('name', $feed->get_title())->first()){
	    	$source = new Source();
	    	$source->name = $feed->get_title();
	    	$source->rss = $request->get('rss');
	    	if($feed->get_image_url()){
	    		$source->logo = $feed->get_image_url();
	    	}
	    	// Auth::user()->sources()->attach($source);
	    	$source->save();
	    }
    	$source->users()->attach(Auth::user());


    	return redirect('/sources');
    }

    public function deleteSource($id){
        $source = Source::find($id);
        $source->users()->detach(Auth::user());

        return redirect('/sources');
    }
}
