<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
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
use App\Model\BatchType;
use DB;
use Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**moinul created */
        $data['allstudents'] = Student::where('activate_status',1)->latest()->paginate(100);
        return view('backend.students.view',$data);

        $data['allstudents'] = User::whereNull('deleted_at')
                            ->where('role_id',3)
                            ->where('status',1)
                            ->latest()
                            ->get();
        return view('backend.students.view',$data);
        /**moinul created */

        $query = Student::query();
        if($request->class_id)
        {
            $data['class_id']   = $request->class_id;
            $query              = $query->where('class_id',$request->class_id);
        }

        if($request->session_id)
        {
            $data['session_id'] = $request->session_id;
            $query              = $query->where('session_id',$request->session_id);
        }

        if($request->batch_setting_id)
        {
            $data['batch_setting_id']   = $request->batch_setting_id;
            $query                      = $query->where('batch_setting_id',$request->batch_setting_id);
        }

        if($request->month_id)
        {
            $data['month_id']   = $request->month_id;
            $query              = $query->where('month_id',$request->month_id);
        }
        if($request->student_type_id)
        {

            $data['student_type_id']    = $request->student_type_id;
            $query                      = $query->where('student_type_id',$request->student_type_id);
        }

        $data['students'] = $query->orderBy('id','DESC')->where('activate_status',1)->get();

        return view('backend.students.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes']        = Classes::all();
        $data['batchTypes']     = BatchType::whereNull('deleted_at')->get();
        $data['sessiones']      = Sessiones::all();
        $data['sectiones']      = Section::all();
        $data['months']         = Month::all();
        $data['student_typies']   = StudentType::all();
        return view('backend.students.add',$data);
    }




     public function getbatchstudentforsms(Request $request)
    {

        $outputstudent = "";

        $class_id           = $request->class_id;
        $session_id         = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;


        $findbatchstudent = Student::where('class_id',$class_id)
                    ->where('session_id',$session_id)
                    ->where('batch_setting_id',$batch_setting_id)
                    ->where('status',1)
                    ->get();

        if($findbatchstudent)
        {
            foreach($findbatchstudent as $student)
            {
                $outputstudent .= "<li> $student->user_id </li>";
            }
        }
        

        return $outputstudent;

    }







    public function getbatchsetting(Request $request)
    {
        $batch = "<option value=''> Select Batch </option>";
        $class_id     = $request->class_id;
        $session_id   = $request->session_id;
        $findbatch = BatchSetting::where('classes_id',$class_id)->where('sessiones_id',$session_id)->get();
        foreach ($findbatch as $key => $value) {
            $batch .= "<option value='$value->id'> $value->batch_name </option>";
        }

        if($findbatch)
        {
            return response()->json([
                'status' => true,
                'batch_setting' => $batch,
            ]);
        }
        return response()->json([
            'status' => false,
            'batch_setting' => $batch,
        ]);
    }

    public function getClassTypeByBatchSetting(Request $request)
    {
        $class_id           = $request->class_id;
        $session_id         = $request->session_id;
        $batch_setting_id   = $request->batch_setting_id;
        $findbatch = BatchSetting::where('classes_id',$class_id)
                    ->where('sessiones_id',$session_id)
                    ->where('id',$batch_setting_id)
                    ->where('status',1)
                    ->first();
        if($findbatch)
        {
            $val = StudentType::findOrFail($findbatch->class_type_id);
            $batch = "<option value='$val->id'> $val->name </option>";
            return response()->json([
                'status' => true,
                'class_type' => $batch
            ]);
        }
        return response()->json([
            'status' => false,
            'class_type' => "<option value=''> Select Batch First </option>",
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
        //return $request;
        $input = $request->all();
        DB::beginTransaction();
        try
        {
            $validator = Validator::make($request->all(), [
                'name'          => 'required',
                'mobile'        => $request->email == NULL ?'required|min:10|max:16':'nullable'.'|unique:users,mobile',
                'email'         => $request->mobile == NULL  ?'required|email':'nullable'.'|unique:users,email',
                'guardianmobile'    => 'required|min:10|max:16',
                'class_id'    => $request->class_id ?'required':'nullable',
                'session_id'  => $request->class_id ?'required':'nullable',
                'batch_setting_id'=> $request->class_id ?'required':'nullable',
                'batch_type_id'=> $request->class_id ?'required':'nullable',
                //'section_id'=> $request->class_id ?'required':'nullable',
                //'student_type_id'=> $request->class_id ?'required':'nullable',
                'admission_date'=> $request->class_id ?'required':'nullable',
                'month_id'      => $request->class_id ?'required':'nullable',
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
                $student->session_id	    = $request->session_id;
                //$student->batch_id          = $findbatchdata?$findbatchdata->batch_id:NULL;
                //$student->section_id        = $request->section_id;
                $student->batch_setting_id  = $request->batch_setting_id;
                $student->batch_type_id     = $request->batch_type_id;
                $student->roll              = $request->roll;
                $student->admission_date    = $request->admission_date;
                //$student->student_type_id   = $request->student_type_id;
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['student'] = User::FindOrFail($id);
        return view('backend.students.show',$data);
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
        $data['sectiones']      = Section::all();
        $data['months']         = Month::all();
        $data['student_typies'] = StudentType::all();
        $data['student']        = Student::FindOrFail($id);
        return view('backend.students.edit',$data);
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
        $input = $request->all();
        DB::beginTransaction();
        try{
         $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'class_id'    => 'required',
            'session_id'  => 'required',
            'batch_setting_id'=> 'required',
            'admission_date'=> 'required',
            'month_id'      => 'required',
            'student_type_id'=> 'required',
            'guardianmobile'=> 'required',
            'status'        => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{


            $findbatchdata = BatchSetting::find($request->batch_setting_id);





            $student = Student::find($id);

            $student->class_id    = $request->class_id;
            $student->session_id  = $request->session_id;
            $student->batch_id      = $findbatchdata->batch_id;
            $student->section_id    = $request->section_id;
            $student->batch_setting_id= $request->batch_setting_id;
            $student->roll          = $request->roll;
            $student->admission_date= $request->admission_date;
            $student->student_type_id= $request->student_type_id;
            $student->month_id      = $request->month_id;
            $student->status        = $request->status;

            $student->save();


            $user = User::find($student->user_id);

            $user->name         = $request->name;
            $user->mobile       = $request->guardian_mobile;
            $user->email        = $request->email;
            $user->student_type_id= $request->student_type_id;
            $user->status        = $request->status;
            $user->save();



            $studentinfo =  StudentInfo::where('user_id',$student->user_id)->first();

            $studentinfo->school_name   = $request->school_name;
            $studentinfo->father        = $request->father;
            $studentinfo->mother        = $request->mother;
            $studentinfo->guardianmobile= $request->guardianmobile;
            $studentinfo->ownmobile     = $request->ownmobile;
            $studentinfo->address       = $request->address;
            $studentinfo->whatsapp_number= $request->whatsapp_number;
            $studentinfo->facebook_id   = $request->facebook_id;
            $studentinfo->bkash_number  = $request->bkash_number;
            $studentinfo->email         = $request->email;
            $studentinfo->address       = $request->address;
            $studentinfo->note          = $request->note;
            $studentinfo->status        = $request->status;

            $studentinfo->save();

        }



        DB::commit();
        $notification = array(
            'message' => 'Student Successfully Update!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.index')->with($notification);
        }
         catch(\Exception $e) {
            dd($e);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            //$data = User::find($id);
            $data = Student::find($id);

            /* $data->students->activate_status = 0;
            $data->students->deleted_at = date('Y-m-d h:i:s');
            $data->students->save();

            $data->studentInfo->status = 0;
            $data->studentInfo->save(); */
            $data->studentInfo->status;
            $data->studentInfo->status = 0;
            $data->studentInfo->save();

            $data->activate_status = 0;
            $data->deleted_at = date('Y-m-d h:i:s');
            $data->save();
            
            $data->user->deleted_at = 0;
            $data->user->status = 0;
            $data->user->save();

            $notification = array(
                'message' => 'Student Successfully Delete!',
                'alert-type' => 'success'
            );
            DB::commit();
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
                'message' => 'Failed to Deleted Student!',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

        /* $student = Student::find($id);
        $student->status = 0;
        $student->status = 0;
        $student->save();
        $studentinfo = StudentInfo::where('user_id',$student->user_id)->first();
        $studentinfo ->status = 0;
        $studentinfo->save(); */
    }

}
