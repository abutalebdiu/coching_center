<?php

namespace App\Http\Controllers\Backend\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WrittenQuestion;
use App\Models\Subject;
use App\Models\Sessiones;
use App\Models\Classes;
use Validator;

class WrittenQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $data['writtenquestiones'] = WrittenQuestion::latest()->get();
          
          return view('backend.questions.writtenquestions.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['subjectes'] = Subject::latest()->get();
         return view('backend.questions.writtenquestions.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
                'class_id'      => $request->class_id ?'required':'nullable',
                'session_id'    => $request->class_id ?'required':'nullable',
                'batch_setting_id'=> $request->class_id ?'required':'nullable',
                'attachment'     => 'required',
                
            ]);
            
            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            else{


                $writtenquestion = New WrittenQuestion();

                $writtenquestion->class_id          = $request->class_id;
                $writtenquestion->session_id        = $request->session_id;
                $writtenquestion->batch_setting_id  = $request->batch_setting_id;

               
                $attachment = $request->attachment;

                if($attachment){
                  
                    $uniqname = uniqid();
                    $ext = strtolower($attachment->getClientOriginalExtension());
                    $filepath = 'public/uploads/questions/';
                    $imagename = $filepath.$uniqname.'.'.$ext;
                    $attachment->move($filepath,$imagename);
                    $writtenquestion->attachment = $imagename;
                }

                $writtenquestion->description   = $request->description;
                $writtenquestion->subject_id    = $request->subject_id;
                $writtenquestion->question_type = $request->question_type;
                $writtenquestion->amount        = $request->amount;
                $writtenquestion->status        = $request->status;

                $writtenquestion->save();



                $notification = array(
                    'message' => 'Question Create Successfully!',
                    'alert-type' => 'success'
                );

                return redirect()->route('written.question.index')->with($notification);
            }  


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['subjectes']      = Subject::latest()->get();
        $data['question']       = WrittenQuestion::find($id);

        return view('backend.questions.writtenquestions.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
                'class_id'      => $request->class_id ?'required':'nullable',
                'session_id'    => $request->class_id ?'required':'nullable',
                'batch_setting_id'=> $request->class_id ?'required':'nullable',
            ]);
            
            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }
            else{


                $writtenquestion = WrittenQuestion::find($id);

                $writtenquestion->class_id          = $request->class_id;
                $writtenquestion->session_id        = $request->session_id;
                $writtenquestion->batch_setting_id  = $request->batch_setting_id;

               
                $attachment = $request->attachment;

                if($attachment){
                  
                    $uniqname = uniqid();
                    $ext = strtolower($attachment->getClientOriginalExtension());
                    $filepath = 'public/uploads/questions/';
                    $imagename = $filepath.$uniqname.'.'.$ext;
                    $attachment->move($filepath,$imagename);
                    $writtenquestion->attachment = $imagename;
                }

                $writtenquestion->description   = $request->description;
                $writtenquestion->subject_id    = $request->subject_id;
                $writtenquestion->question_type = $request->question_type;
                $writtenquestion->amount        = $request->amount;
                $writtenquestion->status        = $request->status;

                $writtenquestion->save();



                $notification = array(
                    'message' => 'Question Update Successfully!',
                    'alert-type' => 'success'
                );

                return redirect()->route('written.question.index')->with($notification);
            }  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         WrittenQuestion::find($id)->delete();

         $notification = array(
                'message' => 'Question Delete Successfully!',
                'alert-type' => 'success'
        );
        return redirect()->route('written.question.index')->with($notification);

    }
}
