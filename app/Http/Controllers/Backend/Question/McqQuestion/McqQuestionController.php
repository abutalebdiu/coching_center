<?php

namespace App\Http\Controllers\Backend\Question\McqQuestion;

use App\Http\Controllers\Controller;
use App\Model\McqQuestionSubject;
use App\Model\McqQuestion;
use App\Model\McqQuestionOption;

use Illuminate\Http\Request;
use App\Models\Classes;
use App\Models\Sessiones;
use App\Models\Section;
use App\Models\Batch;
use App\Models\StudentType;
use App\Models\BatchSetting;
use App\Models\BatchDayTime;
use App\Model\FeeSetting;
use App\Models\Day;
use Auth;
use Validator;
use DB;
use App\Model\FeeCategory;
use App\Models\ExamType;
use App\Models\Subject;

class McqQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['questions'] = McqQuestionSubject::whereNull('deleted_at')->latest()->paginate(1);
        return view('backend.questions.mcq_question.index',$data);
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
        $data['sectiones']      = Section::all();
        $data['batches']        = Batch::all();
        $data['classtypes']     = StudentType::all();
        $data['daies']          = Day::all();
        $data['examTypies']     = ExamType::all();
        $data['subjects']       = Subject::all();

        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')->where('status',1)->latest()->get();
        return view('backend.questions.mcq_question.create',$data);
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
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(), [
                'class_id'          => 'required',
                'session_id'        => 'required',
                'question_no'       => 'required|unique:mcq_question_subjects',
                'subject_id'        => 'required',
                'question.*'        => 'required',
                //'batch_setting_id'  => 'required',
                //'section_id'        => 'required',

                //'activate_status'   => $request->previous_admitted == "" ?'required':'nullable',
            ]);

            if ($validator->fails()){
                return redirect()->back()
                            ->withErrors($validator)
                            ->withInput();
            }

        $subject = new McqQuestionSubject();
        $subject->class_id              = $request->class_id;
        $subject->session_id            = $request->session_id;
        $subject->subject_id            = $request->subject_id;
        $subject->examination_type_id   = $request->examination_type_id;
        $subject->question_no           = $request->question_no;
        $subject->created_by            = Auth::user()->id;
        $subject->status                = 1;
        $subject->save();
        foreach ($request->question as $key => $qus)
        {
            $mcqQ =  new McqQuestion();
            $mcqQ->class_id         = $request->class_id;
            $mcqQ->session_id       = $request->session_id;
            $mcqQ->mcq_subject_id   = $subject->id;
            $mcqQ->question         = $qus;
            $mcqQ->created_by       = Auth::user()->id;
            $mcqQ->status           = 1;
            $data = $mcqQ->save();

                foreach($request->input($key.'_pattern') as $index => $patt)
                {
                    $mcqQOpt =  new McqQuestionOption();
                    $mcqQOpt->mcq_subject_id    = $subject->id;
                    $mcqQOpt->mcq_question_id   = $mcqQ->id;
                    $mcqQOpt->pattern           = $patt;
                    $mcqQOpt->option            = $request->input($key.'_option')[$index];
                    $mcqQOpt->answer            = $request->input($key.'_answer')[$index];
                    $mcqQOpt->created_by        = Auth::user()->id;
                    $mcqQOpt->status            = 1;
                    $mcqQOpt->save();
                }
        }//end main foreach

            DB::commit();
            $notification = array(
                'message' => 'Mcq Question created Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('admin.mcq.index')->with($notification);
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
        return $request;

          /* $string = 'pattern_0_10';
        $len = strlen($string) . '<br/>';
        $right_len =  strrpos($string,"_");
        $needCut = $len - ($right_len+1);
        echo $needCut .'<br/>'; // pattern_0_ */

        //echo substr($string,0,-$needCut);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\McqQuestionSubject  $mcqQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function show(McqQuestionSubject $mcqQuestionSubject)
    {
        $data['question'] = $mcqQuestionSubject;
        return view('backend.questions.mcq_question.show',$data);
    }
    public function exam(McqQuestionSubject $mcqQuestionSubject)
    {
        $examTotalTime  =   "30:00";
        $examStarTime   =   strtotime("10:00 pm");
        $nowTime        =   time();
        $examEndTime    =   strtotime("10:30 pm");
        $remainingTime  =   $examEndTime - $nowTime;
        $data['remaingTime']= number_format(($remainingTime / 60),2,':','');
        $data['question'] = $mcqQuestionSubject;
        return view('backend.questions.mcq_exam.create',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\McqQuestionSubject  $mcqQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function edit(McqQuestionSubject $mcqQuestionSubject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\McqQuestionSubject  $mcqQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, McqQuestionSubject $mcqQuestionSubject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\McqQuestionSubject  $mcqQuestionSubject
     * @return \Illuminate\Http\Response
     */
    public function destroy(McqQuestionSubject $mcqQuestionSubject)
    {
        //
    }
}
