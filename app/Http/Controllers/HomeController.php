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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['articles'] = Article::orderBy('published_date', 'desc')->get();
        $data['articles'] = Auth::user()->articles();

        return view('dashboard', $data);
    }
}
