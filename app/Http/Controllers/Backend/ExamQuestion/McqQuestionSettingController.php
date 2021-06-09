<?php

namespace App\Http\Controllers\Backend\ExamQuestion;

use App\Http\Controllers\Controller;
use App\Model\McqExamSetting;
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
use DB;
use Validator;
use Auth;
class McqQuestionSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['questions'] = ExamSetting::whereNull('deleted_at')->where('fee_cat_id',4)->latest()->paginate(100);
        return view('backend.questions.mcq_question_setting.index',$data);
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


        $mcqSubjectQes = McqQuestionSubject::find($request->qid);
        $data['mcqSubjectName']             = $mcqSubjectQes?$mcqSubjectQes->subjects?$mcqSubjectQes->subjects->name:NULL:NULL;
        $data['mcqSubjectQuestionName']     = $mcqSubjectQes?$mcqSubjectQes->question_no:NULL;

        $data['mcq_question_subject_id']    = $request->qid;
        $data['mcq_subject_id']             = $mcqSubjectQes?$mcqSubjectQes->subject_id:NULL;
        $data['class_id']                   = $mcqSubjectQes?$mcqSubjectQes->class_id:NULL;
        $data['className']                  = $mcqSubjectQes?$mcqSubjectQes->classes?$mcqSubjectQes->classes->name:NULL:NULL;
        $data['session_id']                 = $mcqSubjectQes?$mcqSubjectQes->session_id:NULL;
        $data['sessionName']                = $mcqSubjectQes?$mcqSubjectQes->sessiones?$mcqSubjectQes->sessiones->name:NULL:NULL;
        $data['examination_type_id']        = $mcqSubjectQes?$mcqSubjectQes->examination_type_id:NULL;
        $data['ExamTypeName']               = $mcqSubjectQes?$mcqSubjectQes->examtypies?$mcqSubjectQes->examtypies->name:NULL:NULL;

        /**Batch Setting by class and session id */
        $data['batches'] = BatchSetting::where('status',1)
                ->where('sessiones_id',$data['session_id'])
                ->where('classes_id',$data['class_id'])
                ->latest()
                ->get();
        /**Batch Setting by class and session id */
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
                                ->where('fee_category_type_id',2)
                                ->whereIn('id',[4])
                                ->where('status',1)
                                //->latest()
                                ->get();

        $data['examination_type_id']        = $mcqSubjectQes?$mcqSubjectQes->examination_type_id:NULL;
        return view('backend.questions.mcq_question_setting.create',$data);
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
            'examination_type_id'  => 'required',
            'mcq_subject_id'    => 'required',
            'mcq_question_subject_id'  => 'required',
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
                    ->where('subject_id',$request->mcq_subject_id)
                    ->where('question_subject_id',$request->mcq_question_subject_id)
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

            $mcqExSetting = new ExamSetting();
            $mcqExSetting->fee_cat_id           = $request->fee_cat_id;
            $mcqExSetting->batch_setting_id     = $request->batch_setting_id;
            $mcqExSetting->batch_type_id        = $request->batch_type_id;
            $mcqExSetting->class_id             = $request->class_id;
            $mcqExSetting->session_id           = $request->session_id;
            $mcqExSetting->examination_type_id  = $request->examination_type_id;
            $mcqExSetting->subject_id           = $request->mcq_subject_id;
            $mcqExSetting->question_subject_id  = $request->mcq_question_subject_id;
            $mcqExSetting->exam_start_time      = $request->exam_start_time;
            $mcqExSetting->exam_end_time        = $request->exam_end_time;
            $mcqExSetting->exam_start_date      = $request->exam_start_date;
            $mcqExSetting->total_exam_time      = $total_exam_time;
            $mcqExSetting->exam_status          = 1;
            $mcqExSetting->status               = 1;
            $mcqExSetting->created_by           = Auth::user()->id;
            $mcqExSetting->save();


            $data = new FeeAmountSetting();
            $data->fee_cat_id           = $request->fee_cat_id;
            $data->class_id             = $request->class_id;
            $data->session_id           = $request->session_id;
            $data->batch_type_id        = $request->batch_type_id;
            $data->batch_setting_id     = $request->batch_setting_id;
            $data->pay_time_id          = $request->pay_time_id;
            $data->amount               = $request->amount;
            $data->origin_id            = $mcqExSetting->id;
            $data->created_by           = Auth::user()->id;
            $data->status               = 1;
            $data->save();

            DB::commit();
            $notification = array(
                'message' => 'Mcq Question Setting Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.mcq-setting.index')->with($notification);
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
     * @param  \App\Model\McqExamSetting  $mcqExamSetting
     * @return \Illuminate\Http\Response
     */
    public function show(McqExamSetting $mcqExamSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\McqExamSetting  $mcqExamSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(McqExamSetting $mcqExamSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\McqExamSetting  $mcqExamSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, McqExamSetting $mcqExamSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\McqExamSetting  $mcqExamSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(McqExamSetting $mcqExamSetting)
    {
        //
    }
}
