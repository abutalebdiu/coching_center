<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\BatchSetting;
use DB;
use App\Models\Notice;
use App\Models\Blog;
use App\Models\Contact;


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



	/*for batch details */

	public function batchenroll($id)
	{
		$data['batchsetting']  = BatchSetting::find($id);
		return view('frontend.pages.batchenroll',$data);
	}


	public function details($slug)
	{	

	

 
		return view('frontend.pages.detail',$data);
	}



	public function category($slug)
	{

		 

		return view('frontend.pages.category',$data);
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
