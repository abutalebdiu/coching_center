<?php

namespace App\Http\Controllers\Backend\ExamQuestion;

use App\Model\WrittenExamSetting;
use App\Http\Controllers\Controller;
use App\Model\ExamSetting;
use Illuminate\Http\Request;


use App\Model\FeeAmountSetting;
use App\Model\FeeSetting;

use App\Model\FeeCategory;
use App\Model\FeeActionType;

use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\Batch;

use App\Model\McqQuestionSubject;
use App\Model\PayTime;
use App\Model\BatchType;
use App\Models\BatchSetting;
use App\Models\StudentType;
use App\Models\WrittenQuestion;
use DB;
use Validator;
use Auth;

class WrittenExamSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['questions'] = ExamSetting::whereNull('deleted_at')->where('fee_cat_id',5)->latest()->paginate(100);
        return view('backend.questions.written_question_setting.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       /*though it is not using, but maybe will be uses */
       $data['classes']            = Classes::where('status',1)->get();
       $data['sessiones']          = Sessiones::where('status',1)->get();
       /*though it is not using, but maybe will be uses */

       $data['batchTypies']        = BatchType::where('status',1)->get();
       $data['payTimes']           = PayTime::where('status',1)->get();


       $writSubjectQestion = WrittenQuestion::find($request->qid);
       $data['subjectName']             = $writSubjectQestion?$writSubjectQestion->subject?$writSubjectQestion->subject->name:NULL:NULL;
       $data['subjectQuestionName']     = $writSubjectQestion?$writSubjectQestion->question_no:NULL;

       $data['question_subject_id']    = $request->qid;
       $data['subject_id']             = $writSubjectQestion?$writSubjectQestion->subject_id:NULL;
       $data['class_id']                   = $writSubjectQestion?$writSubjectQestion->class_id:NULL;
       $data['className']                  = $writSubjectQestion?$writSubjectQestion->classes?$writSubjectQestion->classes->name:NULL:NULL;
       $data['session_id']                 = $writSubjectQestion?$writSubjectQestion->session_id:NULL;
       $data['sessionName']                = $writSubjectQestion?$writSubjectQestion->sessiones?$writSubjectQestion->sessiones->name:NULL:NULL;
       $data['examination_type_id']        = $writSubjectQestion?$writSubjectQestion->examination_type_id:NULL;
       $data['ExamTypeName']               = $writSubjectQestion?$writSubjectQestion->examtypies?$writSubjectQestion->examtypies->name:NULL:NULL;

       /**Batch Setting by class and session id */
       $data['batches'] = BatchSetting::where('status',1)
               ->where('sessiones_id',$data['session_id'])
               ->where('classes_id',$data['class_id'])
               ->latest()
               ->get();
       /**Batch Setting by class and session id */
       $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
                               ->where('fee_category_type_id',2)
                               ->whereIn('id',[5])
                               ->where('status',1)
                               //->latest()
                               ->get();

       $data['examination_type_id']        = $writSubjectQestion?$writSubjectQestion->examination_type_id:NULL;
       return view('backend.questions.written_question_setting.create',$data);
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
            'class_id'          => 'required',
            'session_id'        => 'required',
            'batch_setting_id'  => 'required',
            'batch_type_id'     => 'required',
            'examination_type_id' => 'required',
            'subject_id'        => 'required',
            'question_subject_id'  => 'required',
            'exam_start_time'   => 'required',
            'exam_end_time'     => 'required',
            'exam_start_date'   => 'required',
            'fee_cat_id'   => 'required',
            'pay_time_id'       => 'required',
            'amount'            => 'required',

            //'activate_status'   => $request->previous_admitted == "" ?'required':'nullable',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        DB::beginTransaction();
        try
        {
            $exist = ExamSetting::where('fee_cat_id',$request->fee_cat_id)
                    ->where('class_id',$request->class_id)
                    ->where('session_id',$request->session_id)
                    ->where('batch_type_id',$request->batch_type_id)
                    ->where('batch_setting_id',$request->batch_setting_id)
                    ->where('examination_type_id',$request->examination_type_id)
                    ->where('subject_id',$request->subject_id)
                    ->where('question_subject_id',$request->question_subject_id)
                    //->where('pay_time_id',$request->pay_time_id)
                    ->where('exam_status',1)
                    ->where('status',1)
                    ->first();
            if($exist)
            {
                $notification = array(
                    'message' => 'Already Inserted,Please try another fields!',
                    'alert-type' => 'warning'
                );
                return redirect()->back()->with($notification);
            }


            $total_exam_time = ((strtotime($request->exam_end_time) - strtotime($request->exam_start_time)) / 60);

            $examSetting = new ExamSetting();
            $examSetting->fee_cat_id           = $request->fee_cat_id;
            $examSetting->batch_setting_id     = $request->batch_setting_id;
            $examSetting->batch_type_id        = $request->batch_type_id;
            $examSetting->class_id             = $request->class_id;
            $examSetting->session_id           = $request->session_id;
            $examSetting->examination_type_id  = $request->examination_type_id;
            $examSetting->subject_id           = $request->subject_id;
            $examSetting->question_subject_id  = $request->question_subject_id;
            $examSetting->exam_start_time      = $request->exam_start_time;
            $examSetting->exam_end_time        = $request->exam_end_time;
            $examSetting->exam_start_date      = $request->exam_start_date;
            $examSetting->total_exam_time      = $total_exam_time;
            $examSetting->exam_status          = 1;
            $examSetting->status               = 1;
            $examSetting->created_by           = Auth::user()->id;
            $examSetting->save();

            $data = new FeeAmountSetting();
            $data->fee_cat_id           = $request->fee_cat_id;
            $data->class_id             = $request->class_id;
            $data->session_id           = $request->session_id;
            $data->batch_type_id        = $request->batch_type_id;
            $data->batch_setting_id     = $request->batch_setting_id;
            $data->pay_time_id          = $request->pay_time_id;
            $data->amount               = $request->amount;
            $data->origin_id            = $examSetting->id;
            $data->created_by           = Auth::user()->id;
            $data->status               = 1;
            $data->save();

            DB::commit();
            $notification = array(
                'message' => 'Mcq Question Setting Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.written-setting.index')->with($notification);
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
     * @param  \App\Model\WrittenExamSetting  $writtenExamSetting
     * @return \Illuminate\Http\Response
     */
    public function show(WrittenExamSetting $writtenExamSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\WrittenExamSetting  $writtenExamSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(WrittenExamSetting $writtenExamSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\WrittenExamSetting  $writtenExamSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WrittenExamSetting $writtenExamSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\WrittenExamSetting  $writtenExamSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(WrittenExamSetting $writtenExamSetting)
    {
        //
    }
}
