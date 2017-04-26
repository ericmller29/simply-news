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
        $this->middleware('auth');
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
        $data['articles'] = Auth::user()->articles($id);
        $data['sources'] = Auth::user()->sources;
        $data['source_id'] = $id;

        return view('dashboard', $data);
    }
}
