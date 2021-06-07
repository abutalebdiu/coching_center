<?php

namespace App\Http\Controllers\Backend\Question;

use App\Models\QuizQuestion;
use App\Models\QuizQuestionOption;
use \App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentInfo;
use App\Models\Month;
use App\Models\Year;
use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Classes;
use App\User;
use App\Models\AbsentStudent;
use App\Models\Batch;
use App\Models\BatchSetting;
use App\Models\StudentType;
use DB;
use Validator;
use App\Models\Quiz;

class QuizQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['classes'] = Classes::all();
        $data['sessiones'] = Sessiones::all();
        $data['quizzes'] = Quiz::latest()->get();
        $data['quizquestiones'] = QuizQuestion::latest()->get();
        return view('backend.questions.quizoptions.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['quizzes'] = Quiz::latest()->get();
        return view('backend.questions.quizoptions.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $input = $request->all();
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(), [
                'quiz_id'            => 'required',
                'question_name'            => 'required',  
            ]);
            
            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }  
        
            

            $QuizQuestion = new QuizQuestion();
        
            $QuizQuestion->quiz_id      = $request->quiz_id;
            $QuizQuestion->question_name= $request->question_name;
            $QuizQuestion->status       = 1;
            
            $QuizQuestion->save();
 



            if($request->option_name != ''){
                if(!empty($input['option_name']))
                {
                    foreach ($input['option_name'] as $key => $value) {
                        $QuizQuestionOption = New QuizQuestionOption();
                        $QuizQuestionOption->quiz_question_id = $QuizQuestion->id;
                        $QuizQuestionOption->option_name = $input['option_name'][$key];
                        $QuizQuestionOption->answer = $input['answer'][$key];

                        $QuizQuestionOption->save();
                    }
                }
            }







            DB::commit();
            $notification = array(
                'message' => 'Question Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('quizquestion.index')->with($notification);
        } 
         catch(\Exception $e) {
            DB::rollback();
            if($e->getMessage())
            {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();

            }

            $notification = array(
                'message' => 'Failed to Submit Student Info!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function show(QuizQuestion $quizQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizQuestion $quizQuestion,$id)
    {
        $data['quizzes']        = Quiz::latest()->get();
        $data['quizquestion']   = QuizQuestion::find($id);
        return view('backend.questions.quizoptions.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizQuestion $quizQuestion,$id)
    {
        //return $request;
        $input = $request->all();
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(), [
                'quiz_id'            => 'required',
                'question_name'            => 'required',  
            ]);
            
            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }  
        
            

            $QuizQuestion =  QuizQuestion::find($id);
        
            $QuizQuestion->quiz_id      = $request->quiz_id;
            $QuizQuestion->question_name= $request->question_name;
            $QuizQuestion->status       = 1;
            
            $QuizQuestion->save();
 



            if($request->option_name != ''){
                if(!empty($input['option_name']))
                {
                    QuizQuestionOption::where('quiz_question_id',$id)->delete();

                    foreach($input['option_name'] as $key => $value){

                        $QuizQuestionOption = New QuizQuestionOption();
                        $QuizQuestionOption->quiz_question_id = $QuizQuestion->id;
                        $QuizQuestionOption->option_name = $input['option_name'][$key];
                        $QuizQuestionOption->answer = $input['answer'][$key];

                        $QuizQuestionOption->save();
                    }
                }
            }

 
            DB::commit();
            $notification = array(
                'message' => 'Question Successfully Updated!',
                'alert-type' => 'success'
            );
            return redirect()->route('quizquestion.index')->with($notification);
        } 
         catch(\Exception $e) {
            DB::rollback();
            if($e->getMessage())
            {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();

            }

            $notification = array(
                'message' => 'Failed to Submit Student Info!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizQuestion  $quizQuestion
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizQuestion $quizQuestion,$id)
    {
        QuizQuestionOption::where('quiz_question_id',$id)->delete();
        QuizQuestion::find($id)->delete();

        $notification = array(
            'message' => 'Question Delete Successfully!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);

    }
}
