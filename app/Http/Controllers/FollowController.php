<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notifications\FollowNotification;
use Auth;
use App\Question;
use App\User;
use App\Label;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user($id)
    {
        $user = User::find($id);
        $data = ['user_id'=>Auth::id()];
        if (!$user->follow()->where($data)->delete()) {
            $user->follow()->create($data);
            $user->notify(new FollowNotification());
        }
        return back();
    }

    public function question($id)
    {
        $follower = Question::find($id)->follow();
        $data = ['user_id'=>Auth::id()];
        if(!$follower->where($data)->delete()){
            $follower->create($data);
        }
        return back();
    }

    public function label($id)
    {
        $follower = Label::find($id)->follow();
        $data = ['user_id'=>Auth::id()];
        if(!$follower->where($data)->delete()){
            $follower->create($data);
        }
        return back();
    }
}
