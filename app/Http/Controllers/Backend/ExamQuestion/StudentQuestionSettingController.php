<?php

namespace App\Http\Controllers\Backend\ExamQuestion;

use App\Http\Controllers\Controller;
use App\Model\StudentQuestionSetting;
use Illuminate\Http\Request;


use App\Model\McqExamSetting;
use App\Model\ExamSetting;


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
use App\Models\Student;
use DB;
use Validator;
use Auth;

use App\Traits\McqExamStudentAnswerSummary;

class StudentQuestionSettingController extends Controller
{
    use McqExamStudentAnswerSummary;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mcqIndex()
    {
        $data['questions'] = StudentQuestionSetting::whereNull('deleted_at')
                            ->where('exam_capability',1)
                            ->select('*',DB::raw('COUNT(id) as totalApprovedStudenForExam'))
                            ->latest()
                            ->groupBy(['batch_setting_id','batch_type_id','fee_cat_id','exam_setting_id',
                                'class_id' , 'session_id'
                            ])
                            ->paginate(100);
        return view('backend.questions.question_studen_setting.mcq.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mcqCreate(Request $request)
    {
        /*though it is not using, but maybe will be uses */
        $data['classes']            = Classes::where('status',1)->get();
        $data['sessiones']          = Sessiones::where('status',1)->get();
        /*though it is not using, but maybe will be uses */

        $data['batchTypies']        = BatchType::where('status',1)->get();
        $data['payTimes']           = PayTime::where('status',1)->get();

        $examSet                            = ExamSetting::find($request->qid);

        $mcqSubjectQes                      = McqQuestionSubject::find($examSet?$examSet->question_subject_id:NULL);
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

        $data['batchSettingName']           = $examSet?$examSet->batchsetting?$examSet->batchsetting->batch_name:NULL:NULL;
        $data['batchSettingId']             = $examSet?$examSet->batch_setting_id:NULL;

        $data['batchTypeName']              = $examSet?$examSet->batchTypies?$examSet->batchTypies->name:NULL:NULL;
        $data['batchTypeId']                = $examSet?$examSet->batch_type_id:NULL;

        $data['question']                  = $examSet ;


        /**Batch Setting by class and session id */
        $data['batches'] = BatchSetting::where('status',1)
                ->where('sessiones_id',$data['session_id'])
                ->where('classes_id',$data['class_id'])
                ->latest()
                ->get();
        /**Batch Setting by class and session id */
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')
                                ->where('fee_category_type_id',2)
                                ->where('status',1)
                                //->latest()
                                ->get();

        $data['examination_type_id']        = $mcqSubjectQes?$mcqSubjectQes->examination_type_id:NULL;
        if($request->qtype == 'mcq')
        {
            return view('backend.questions.question_studen_setting.mcq.create',$data);
        }else{
            return redirect()->back();
        }
    }


    public function mcqCreateStudentList(Request $request)
    {
        $request->class_id;
        $request->session_id;
        $request->batch_setting_id;
        $request->batch_type_id;

        $data['students'] = Student::where('activate_status',1)
                ->where('batch_setting_id',$request->batch_setting_id)//
                ->where('class_id',$request->class_id)
                ->where('session_id',$request->session_id)
                ->where('batch_type_id',$request->batch_type_id)
                ->get();
        $html = view('backend.questions.question_studen_setting.mcq.ajax_student_list',$data)->render();
        if($data['students'])
        {
            return response()->json([
                'status'    => true,
                'html'      => $html
            ]);
        }
    }



    public function mcqStoreStudent(Request $request)
    {
        $existdata = StudentQuestionSetting::whereNull('deleted_at')
            ->where('class_id',$request->class_id)
            ->where('session_id',$request->session_id)
            ->where('batch_setting_id',$request->batch_setting_id)
            ->where('batch_type_id',$request->batch_type_id)

            ->where('origin_id',$request->question_subject_id)
            ->where('fee_cat_id',$request->fee_cat_id)
            ->where('fee_amount_setting_id',$request->fee_amount_setting_id)

            //->where('examination_type_id',$request->examination_type_id)
            ->where('exam_setting_id',$request->exam_setting_id)
            ->where('student_id',$request->student_id)
            //->where('exam_capability',1)
            ->first();

        if($existdata)
        {
            if($request->action_type == 'in_active' && $existdata->exam_capability == 1)
            {
                $existdata->exam_capability = NULL;
                $capability = "Inactive";
            }else{
                $existdata->exam_capability = 1;
                $capability = "active";
            }
            $existdata->save();
        }
        else{
            $studentQSet = new StudentQuestionSetting();
            $studentQSet->class_id              =   $request->class_id;
            $studentQSet->session_id            =   $request->session_id;
            $studentQSet->batch_setting_id      =   $request->batch_setting_id;
            $studentQSet->batch_type_id         =   $request->batch_type_id;

            $studentQSet->fee_cat_id            =   $request->fee_cat_id;
            $studentQSet->fee_amount_setting_id =   $request->fee_amount_setting_id;
            $studentQSet->origin_id             =   $request->question_subject_id;

            //$studentQSet->question_subject_id   =   $request->question_subject_id;
            //$studentQSet->subject_id            =   $request->subject_id;

            //$studentQSet->examination_type_id   =   $request->examination_type_id;
            $studentQSet->exam_setting_id       =   $request->exam_setting_id;
            $studentQSet->student_id            =   $request->student_id;
            $studentQSet->exam_capability       =   1;
            $studentQSet->created_by            =   Auth::user()->id;
            $studentQSet->save();

            $capability  = "active";

        }

        $this->class_id             = $request->class_id;
        $this->session_id           = $request->session_id;
        $this->student_id           = $request->student_id;
        $this->batch_setting_id     = $request->batch_setting_id;
        $this->batch_type_id        = $request->batch_type_id;
        $this->question_subject_id  = $request->question_subject_id;
        $this->examination_type_id  = $request->examination_type_id;
        $this->exam_setting_id      = $request->exam_setting_id;
        $this->subject_id           = $request->subject_id;
        $this->status               = $capability == "active" ? 1 : NULL;
        $this->insertStudentInTblMacExamStudentAnsSurrary();

        return response()->json([
            'status'    => true,
            'capability' => $capability
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\StudentQuestionSetting  $studentQuestionSetting
     * @return \Illuminate\Http\Response
     */
    public function show(StudentQuestionSetting $studentQuestionSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\StudentQuestionSetting  $studentQuestionSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentQuestionSetting $studentQuestionSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\StudentQuestionSetting  $studentQuestionSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentQuestionSetting $studentQuestionSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\StudentQuestionSetting  $studentQuestionSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentQuestionSetting $studentQuestionSetting)
    {
        //
    }
}
