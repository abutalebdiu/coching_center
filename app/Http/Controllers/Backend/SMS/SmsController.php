<?php

namespace App\Http\Controllers\Backend\SMS;

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
use DB;
use Validator;
use App\Models\SmsTemplete;
use Auth;


class SmsController extends Controller
{
    

    /*all student sms */

    public function allstudentsms()
    {
        return view('backend.sms.sms.allstudent');
    }

 	public function allstudentsmssend()
    {
        
    }





    public function batchsms()
    {
    	$data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();

    	return view('backend.sms.sms.batch',$data);
    }

    public function batchsmssend()
    {

    }




    /*single student sms*/
    public function singlesms()
    {
    	$data['students'] = User::where('role_id',3)->get();
    	return view('backend.sms.sms.single',$data);
    }


	public function singlesmssend()
    {
    	return view('backend.sms.sms.single');
    }





    /*custom student sms*/

    public function customsms()
    {
    	$data['classes']        = Classes::all();
        $data['sessiones']      = Sessiones::all();
    	return view('backend.sms.sms.surprise',$data);
    }


    /*surprise sms send method*/

    public function customsmssend()
    {

    }






}
