<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Label;
use App\Question;
use App\Follower;
use Auth;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$a = Follower::with('followerable')->where('user_id',Auth::id())->get();

        //$questions = Question::with(['user'=>function($q){$q->select(['id','name']);}])
        //    ->latest('updated_at')->get();
        $questions = Question::paginate(10);
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        //标签新增
        $labels = Label::upsert($request->get('labels'));

        //问题新增
        $data = [
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'user_id' => Auth::id(),
        ];
        $question = Question::create($data);
        $question->labels()->attach($labels);
        return redirect()->route('question.show', [$question->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Request('mask') == 'read' )
        {
        }
        $question = Question::with(['user','answers'])->findOrFail($id);
        return view('question.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);

        return $question->user->id == Auth::id() ? view('question.edit',compact('question')) : abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, $id)
    {
        $question = Question::find($id);
         //标签新增
        $labels = Label::upsert($request->get('labels'));

        //问题新增
        $data = [
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ];
        $question->update($data);

        $question->labels()->sync($labels);

        return redirect()->route('question.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
