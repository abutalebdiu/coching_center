<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\BatchSetting;
use DB;
use App\Models\Notice;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\BlogCategory;
use App\Models\Sessiones;
use App\Models\Classes;
use App\About;
use App\Models\OldQuestion;
use App\Models\Subject;
use App\Models\Year;
use App\Models\ExamType;
use App\Models\BoardQuestionType;

class FrontendController extends Controller
{
    
	public function index()
	{

		$data['sliders'] 		= Slider::where('status',1)->get();
		$data['BatchSettings']  = BatchSetting::where('status',1)->get();
		$data['notices']  		= Notice::where('status',1)->get();
		$data['blogs']  		= Blog::where('status',1)->get();

		return view('frontend.pages.index',$data);
	}




	public function about()
	{
		$data['about'] = About::find(2);
		return view('frontend.pages.about',$data);
	}


	public function boardquestiones(Request $request)
	{

        $data['years'] = Year::all();
        $data['exams'] = ExamType::all();
        $data['board_questions'] = BoardQuestionType::all();
        $data['classs'] = Classes::all();
        $data['subjects'] = Subject::all();

		$query = OldQuestion::query();


		if($request->type_id)
		{
			$data['type_id']  = $request->type_id;
			$query = $query->where('board_question_type_id',$request->type_id);
		}

		if($request->year_id)
		{
			$data['year_id'] = $request->year_id;
			$query = $query->where('year_id',$request->year_id);
 		}

 		if($request->subject_id)
 		{
 			$data['subject_id'] = $request->subject_id;
 			$query = $query->where('subject_id',$request->subject_id);
 		}


		$data['boardquestiones'] =  $query->where('question_type_id',2)->latest()->paginate(2);

		return view('frontend.pages.boardquestiones',$data);
	}





	public function schoolquestiones(Request $request)
	{
		
        $data['years'] = Year::all();
        $data['exams'] = ExamType::all();
        $data['board_questions'] = BoardQuestionType::all();
        $data['classs'] = Classes::all();
        $data['subjects'] = Subject::all();

		$query = OldQuestion::query();


		if($request->type)
		{
			$data['type']  = $request->type;
			$query = $query->where('board_question_type_id',$request->type);
		}

		if($request->year)
		{
			$data['year'] = $request->year;
			$query = $query->where('year_id',$request->year);
 		}

 		if($request->subject)
 		{
 			$data['subject_id'] = $request->subject_id;
 			$query = $query->where('subject_id',$request->subject_id);
 		}


		$data['schoolquestiones'] =  $query->where('question_type_id',1)->latest()->paginate(2);

		return view('frontend.pages.schoolquestiones',$data);


	}









	public function allbatch()
	{

		$data['classes'] 	= Classes::all();
		$data['sessiones']  = Sessiones::all();

 

		$data['BatchSettings'] =  BatchSetting::where('status',1)->get();
		return view('frontend.pages.allbatch',$data);
	}





	/*for batch details */

	public function batchenroll($id)
	{
		$data['batchsetting']  = BatchSetting::find($id);
		return view('frontend.pages.batchenroll',$data);
	}



 




	/*for blogs*/


	public function blogs()
	{
		$data['blogs'] = Blog::latest()->get();
		return view('frontend.pages.blogs',$data);
	}

	public function blogdetail($slug)
	{
		$data['categories'] = BlogCategory::all();

		$data['blogs'] = Blog::latest()->limit(6)->whereNotIn('slug',[$slug])->get();

		$data['blog'] = Blog::where('slug',$slug)->first();

		return view('frontend.pages.blogdetail',$data);
 	}






	/*for notices */

	public function notices()
	{
		$data['notices'] = Notice::latest()->paginate(2);
		return view('frontend.pages.notices',$data);
	}

	public function noticedetail($slug)
	{
		$data['notices'] = Notice::latest()->get();
		return view('frontend.pages.noticedetail',$data);
	}




	public function contact()
	{
		return view('frontend.pages.contact');
	}



	public function contactstore(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'mobile' => 'required',
           'email' => 'required',
           'subject' => 'required',
           'message' => 'required',
        ]);

        $contacts = new Contact();
        $contacts->name    = $request->name;
        $contacts->mobile  =  $request->mobile;
        $contacts->email   =  $request->email;
        $contacts->subject =  $request->subject;
        $contacts->message =  $request->message;
        $contacts->status  =  1;
        $contacts->save();

        $notification = array(
            'message' => 'Message Send Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('frontend')->with($notification);
    }






}
