<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        // $data['articles'] = Article::orderBy('published_date', 'desc')->get();
        // return response()->json(Auth::user()->sources);
        if(Auth::check()){
            $data['articles'] = Auth::user()->articles($id);
            $data['sources'] = Auth::user()->sources()->orderBy('name')->get();
        }else{
            $data['articles'] = Article::guest($id);
        }
        $data['source_id'] = $id;

        return view('dashboard', $data);
    }

    public function loadNextArticles($id = null, Request $request){
        if(Auth::check()){
            $articles = Auth::user()->articles($id, $request->get('offset'));
        }else{
            $articles = Article::guest($id, $request->get('offset'));
        }
        
        return response()->json($articles);
    }
}
