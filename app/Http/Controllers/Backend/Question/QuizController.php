<?php

namespace App\Http\Controllers\Backend\Question;

use App\Models\Quiz;
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
use App\Models\Subject;
use DB;
use Validator;

class QuizController extends Controller
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
        return view('backend.questions.quiz.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes'] = Classes::all();
        $data['sessiones'] = Sessiones::all();
        $data['subjects'] = Subject::all();
 
        return view('backend.questions.quiz.create',$data);
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
                'class_id'      => $request->class_id ?'required':'nullable',
                'session_id'    => $request->class_id ?'required':'nullable',
                'batch_setting_id'=> $request->class_id ?'required':'nullable',
                'student_type_id'=> $request->class_id ?'required':'nullable',
                'quiz_name'     => 'required',
                'quiz_time'     => 'required',
                'status'        => 'required',
            ]);
            
            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }  
         
            $quiz  = new Quiz();
            $quiz->classes_id        = $request->class_id;
            $quiz->sessiones_id      = $request->session_id;
            $quiz->batch_setting_id  = $request->batch_setting_id;
            $quiz->subject_id        = $request->subject_id;
            $quiz->quiz_name         = $request->quiz_name;
            $quiz->quiz_description  = $request->quiz_description;
            $quiz->quiz_time         = $request->quiz_time;
            $quiz->status            = $request->status;
             
            $quiz->save();
            
            DB::commit();
            $notification = array(
                'message' => 'Quiz Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('quiz.index')->with($notification);
        } 
         catch(\Exception $e) {
            DB::rollback();
            if($e->getMessage())
            {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();

            }

            $notification = array(
                'message' => 'Failed to Submit Quiz Info!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz,$id)
    {
        $data['quiz']  = Quiz::find($id);
        return view('backend.questions.quiz.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz,$id)
    {
        $data['classes'] = Classes::all();
        $data['sessiones'] = Sessiones::all();
        $data['subjects'] = Subject::all();
        $data['quiz']  = Quiz::find($id);
        return view('backend.questions.quiz.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz,$id)
    {
         //return $request;
        $input = $request->all();
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(), [
                'class_id'      => $request->class_id ?'required':'nullable',
                'session_id'    => $request->class_id ?'required':'nullable',
                'batch_setting_id'=> $request->class_id ?'required':'nullable',
                'student_type_id'=> $request->class_id ?'required':'nullable',
                'quiz_name'     => 'required',
                'quiz_time'     => 'required',
                'status'        => 'required',
            ]);
            
            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }  
         
            $quiz  =  Quiz::find($id);
            $quiz->classes_id        = $request->class_id;
            $quiz->sessiones_id      = $request->session_id;
            $quiz->batch_setting_id  = $request->batch_setting_id;
            $quiz->subject_id        = $request->subject_id;
            $quiz->quiz_name         = $request->quiz_name;
            $quiz->quiz_description  = $request->quiz_description;
            $quiz->quiz_time         = $request->quiz_time;
            $quiz->status            = $request->status;
             
            $quiz->save();
            
            DB::commit();
            $notification = array(
                'message' => 'Quiz Successfully Updated!',
                'alert-type' => 'success'
            );
            return redirect()->route('quiz.index')->with($notification);
        } 
         catch(\Exception $e) {
            DB::rollback();
            if($e->getMessage())
            {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();

            }

            $notification = array(
                'message' => 'Failed to Submit Quiz Info!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        //
    }
}
