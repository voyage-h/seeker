<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;

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
    public function index()
    {
        $res = Question::find(1)->latest('updated_at')
            ->with(['user'=>function($q){$q->select(['id','name']);},
                'labels'=>function($q){$q->select(['labels.id','name']);}])
            ->get()->toArray();

        return view('home');
    }
}
