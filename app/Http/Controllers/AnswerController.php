<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Notifications\AnswerQuestionNotification;
use App\Answer;
use Auth;

class AnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(AnswerRequest $request, $questionId)
    {
        $answer = Answer::updateOrCreate([
            'question_id'=>$questionId,
            'user_id' => Auth::id()],
            ['content'=>$request->get('content')]);

        $answer->question->user->notify(new AnswerQuestionNotification($answer));

        return redirect(url()->previous()."#answer$answer->id");
    }

}
