<?php

namespace App\Http\Controllers;

use App\Notifications\LikeNotification;
use App\Events\NotificationEvent;
use Illuminate\Http\Request;
use App\Like;
use App\Answer;
use Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function answer($id)
    {
//         $answer = Answer::find($id);
//        broadcast(new NotificationEvent($answer->user))->toOthers();
//        return redirect(url()->previous()."#answer$id");

        $data = ['user_id'=>Auth::id(),'answer_id'=>$id];
        $answer = Answer::find($id);

        if (!Like::where($data)->delete()) {
            
            //通知
            $answer->user->notify(new LikeNotification($answer));
            //广播
            broadcast(new NotificationEvent($answer->user))->toOthers();

            Like::create($data);
        }
        return redirect(url()->previous()."#answer$id");
    }
}
