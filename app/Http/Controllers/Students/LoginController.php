<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;


class LoginController extends Controller
{ 
    
    public function studentlogin()
    {
        return view('frontend.studentauth.login');
    }

      
    public function studentauthlogin(Request $request)
    {

         $input = $request->all();

         $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
  
            $fieldType = filter_var($request->mobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
            if(auth()->attempt(array($fieldType => $input['mobile'], 'password' => $input['password'])))
            {
                return redirect()->route('student.dashboard');
            }
            else{

                $notification = array(
                    'message' => 'Something Wrong!',
                    'alert-type' => 'error'
                );

                return redirect()->route('student.login')->with($notification);
                   
            }
     
        }

    }

   
    public function studentregister()
    {
        return view('frontend.studentauth.register');
    }


     
    public function studentregisterstore(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'mobile'    => 'required|unique:users',
            'name'      => 'required',
            'address'   => 'required',
            'password'  => 'required',
            'com_password'  => 'required|same:password',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{


            $checkusercount = User::orderBy('id','DESC')->where('role_id',3)->count();
            $checkuser = User::orderBy('id','DESC')->where('role_id',3)->first();


            $user = new User();

            if($checkusercount>0)
            {
                $user->useruid = $checkuser->useruid+1;
            }
            else{
                $user->useruid = '20210001';
            }

            $user->name     = $request->name;
            $user->mobile   = $request->mobile;
            $user->email    = $request->email;
            $user->password = bcrypt($request->password);
            $user->address  = $request->address;
            $user->role_id  = 3;
            $user->status   = 1;
            $user->save();

            $notification = array(
                'message' => 'Your are registration complete successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('student.login')->with($notification);

        }
    }




    public function studentlogout()
    {
        Auth::logout();

        $notification = array(
                'message' => 'Logout!',
                'alert-type' => 'success'
            );

        return redirect()->route('student.login')->with($notification);
    }

     
}
