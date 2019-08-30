<?php

namespace App\Http\Controllers;
use Auth;
use App\Answer;
use Illuminate\Http\Request;
use App\Question;
class AnswerController extends Controller
{
    
     public function __construct() {
        
        $this->middleware('auth')->except('index');
    }
    
    public function index(Question $question) {
        
        return $question->answers()->with('user')->simplePaginate(2);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate(
                [
                    'body'=>'required'
                ]
                );
       $answer =  $question->answers()->create([
            'body'=>$request->body,
            'user_id'=> Auth::id()
            
        ]);
       if(request()->expectsJson())
       {
           return response()->json([
               
               'message'=>"Your answer has been submited successfully",
               'answer'=>$answer->load('user')
           ]);
       }
        return back()->with('success',"Your answer has been submited successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question,Answer $answer)
    {
        $this->authorize('update',$answer);
        
        return view('answers.edit', compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);
        $answer->update($request->validate([
            'body'=>'required'
        ]));
        if($request->expectsJson()){
            return response()->json([
                'message'=>'You have successfully updated the answer',
                'body_html'=>$answer->body_html
            ]);
        }
        return redirect()->route('question.show',$question->slug)->with('success','You have successfully updated the answers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question,Answer $answer)
    {
        $this->authorize('delete',$answer);
        $answer->delete();
        if(request()->expectsJson())
        {
            return response()->json(
            [
                'message'=>'You have succesfully deleted'
            ]);
        }
        return back()->with('success','Answer deleted successfully');
    }
}
