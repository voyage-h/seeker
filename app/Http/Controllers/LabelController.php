<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Label;

class LabelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function show($id) 
    {
        $label = Label::where('id',$id)->first();
        return view('label.show',compact('label'));
    }
}
