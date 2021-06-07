<?php

namespace App\Http\Controllers\Backend\Attendance;

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
use App\Models\Attendance;
use App\Models\AttendanceDetail;
use DB;
use Validator;
use Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['attendances'] = Attendance::latest()->get();
        return view('backend.attendances.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
        $data['sectiones']      = Section::all();
        $data['months']         = Month::all();
        $data['student_typies'] = StudentType::all();



        $query = Student::query();


        if($request->class_id){
            $query = $query->where('class_id',$request->class_id);
            $data['class_id'] = $request->class_id;
        }
        else{
           $query = $query->where('class_id',100);
        }
        if($request->session_id){
            $query = $query->where('session_id',$request->session_id);
            $data['session_id'] = $request->session_id;
        }

        if($request->batch_setting_id)
        {
            $query = $query->where('batch_setting_id',$request->batch_setting_id);
            $data['batch_setting_id'] = $request->batch_setting_id; 
        }


        if($request->student_type_id)
        {
            $query = $query->where('student_type_id',$request->student_type_id);
            $data['student_type_id'] = $request->student_type_id; 
        }

        if($request->attendance_date)
        {
            $data['attendance_date'] = $request->attendance_date;
        }
        


        if($request->class_id || $request->session_id || $request->batch_setting_id || $request->student_type_id){
            $data['students'] = $query->get();
            $data['datacount'] = $query->count();
        }
        else{
            $data['datacount'] = $query->count();
            $data['students'] = $query->get();
        }

       


        return view('backend.attendances.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        $input = $request->all();
       DB::beginTransaction();
        try
        {
            $attendance = New Attendance();

            $attendance->classes_id     = $request->classes_id;
            $attendance->sessiones_id   = $request->sessiones_id;
            $attendance->batch_setting_id= $request->batch_setting_id;
            $attendance->attendance_date= $request->attendance_date;
            $attendance->is_admin       = Auth::user()->id;
            $attendance->status         =1 ;

            $attendance->save();


            $totalpresent = 0;
            $totalabsent = 0;

            if($request->student !='')
            {
                if(!empty($input['student'])){

                    foreach($input['student'] as $key => $value){
                        $attendancedetail = new AttendanceDetail();
                        $attendancedetail->attendance_id = $attendance->id;
                        $attendancedetail->student_id = $input['student'][$key];
                        $attendancedetail->attendance = $input['attendance'][$key];
                        $attendancedetail->status = 1;
                        $attendancedetail->save();

                        if($input['attendance'][$key] == 'Present')
                        {
                            $totalpresent += $totalpresent+1;
                        }
                        else{
                            $totalabsent += $totalabsent+1;
                        }
                    } 
                }
            }


            $attendanceupdate = Attendance::find($attendance->id);
            $attendanceupdate->total_student = $totalpresent + $totalabsent;
            $attendanceupdate->total_present = $totalpresent;
            $attendanceupdate->total_absent =  $totalabsent;
            $attendanceupdate->save();


            DB::commit();
            $notification = array(
                'message' => 'Attendance Successfully Added!',
                'alert-type' => 'success'
            );
            return redirect()->route('student.attendance.create')->with($notification);
        } 
         catch(\Exception $e) {
            DB::rollback();
            if($e->getMessage())
            {
                // $message = "Something went wrong! Please Try again";
                $message = $e->getMessage();

            }

            $notification = array(
                'message' => 'Failed to Submit Attendance Info!',
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
