<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use DB;
use Validator;
use Auth;
use App\User;
use App\Models\StudentInfo;
use App\Models\BatchSetting;

class StudentController extends Controller
{
    


	public function batchlist()
	{	

		$data['students'] = Student::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
		return view('frontend.studentdashboard.batchlist',$data);
		
	}



	public function batch_detail($id)
	{	
		$data['student'] = Student::where('batch_setting_id',$id)->first();
		$data['setting'] = BatchSetting::where('id',$id)->first();
		return view('frontend.studentdashboard.batch_detail',$data);
		
	}











}
