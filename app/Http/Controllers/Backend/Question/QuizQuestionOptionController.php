<?php

namespace App\Http\Controllers\Backend\Question;

use \App\Http\Controllers\Controller;
use App\Models\QuizQuestionOption;
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
class QuizQuestionOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'name'          => 'required',
                'mobile'        => $request->email == NULL ?'required|min:10|max:16':'nullable'.'|unique:users,mobile',
                'email'         => $request->mobile == NULL  ?'required|email':'nullable'.'|unique:users,email',
                
                'father'            => 'required|max:150',
                'mother'            => 'required|max:150',
                'guardianmobile'    => 'required|min:10|max:16',


                'class_id'    => $request->class_id ?'required':'nullable',
                'session_id'  => $request->class_id ?'required':'nullable',
                'batch_setting_id'=> $request->class_id ?'required':'nullable',
                'section_id'=> $request->class_id ?'required':'nullable',
                'student_type_id'=> $request->class_id ?'required':'nullable',

                'admission_date'=> $request->class_id ?'required':'nullable',
                'roll'=> $request->class_id ?'required':'nullable',
                'month_id'      => $request->class_id ?'required':'nullable',
                'guardianmobile'=> $request->class_id ?'required':'nullable',
                'status'        => $request->class_id ?'required':'nullable',
            ]);
            
            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }  
        
            $existingUser       = User::query();
            $countdata          = $existingUser->count();
            $lastdata           = $existingUser->latest()->first();//User::orderBy('id','DESC')->first();
            $findbatchdata      = BatchSetting::find($request->batch_setting_id);

            $user = new User();
            if($countdata>0)
            {
                $user->useruid = $lastdata->useruid+1;
            }
            else{
                $user->useruid = "2021001";
            }

            $user->name         = $request->name;
            $user->mobile       = $request->mobile;
            $user->email        = $request->email;
            $user->password     = bcrypt(123456789);
            $user->role_id      = 3;
            $user->status       = 1;
            $user->save();

            if($request->class_id)
            {
                $student = New Student();
                $student->user_id           = $user->id;
                $student->class_id          = $request->class_id;
                $student->session_id        = $request->session_id;
                //$student->batch_id          = $findbatchdata?$findbatchdata->batch_id:NULL;
                $student->section_id        = $request->section_id;
                $student->batch_setting_id  = $request->batch_setting_id;
                $student->roll              = $request->roll;
                $student->admission_date    = $request->admission_date;
                $student->student_type_id   = $request->student_type_id;
                $student->start_month_id    = $request->month_id;
                $student->activate_status   = $request->status;
                $student->school_name       = $request->school_name;
                $student->save();
            }

            $studentinfo = New StudentInfo();
            $studentinfo->user_id           = $user->id;
            $studentinfo->father            = $request->father;
            $studentinfo->mother            = $request->mother;
            $studentinfo->guardian_mobile   = $request->guardianmobile;
            $studentinfo->own_mobile        = $request->mobile;
            $studentinfo->address           = $request->address;
            $studentinfo->whatsapp_number   = $request->whatsapp_number;
            $studentinfo->facebook_id       = $request->facebook_id;
            $studentinfo->bkash_number      = $request->bkash_number;
            $studentinfo->email             = $request->email;
            $studentinfo->address           = $request->address;
            $studentinfo->notes             = $request->note;
            $studentinfo->status            = $request->status;
            $studentinfo->save();
            DB::commit();
            $notification = array(
                'message' => 'Student Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('student.index')->with($notification);
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
            return redirect()->back()->with($message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizQuestionOption  $quizQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function show(QuizQuestionOption $quizQuestionOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizQuestionOption  $quizQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizQuestionOption $quizQuestionOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizQuestionOption  $quizQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizQuestionOption $quizQuestionOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizQuestionOption  $quizQuestionOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizQuestionOption $quizQuestionOption)
    {
        //
    }
}
