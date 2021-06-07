<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::whereIn('role_id',[1,2])->get();
        return view('backend.users.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['roles'] = Role::all();
        return view('backend.users.add',$data);
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
            'role_id'   => 'required',
            'name'      => 'required',
            'email'     => 'required|unique:users|email',
            'mobile'    => 'required',
            'password'  => 'required',
            'status'    => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $lastusercount = User::where('role_id',[1,2])->count();
            $lastuserid    = User::where('role_id',[1,2])->orderBy('id','DESC')->first();

            $user          = New User();

             if($lastusercount>0)
            {
                $user->useruid         = $lastuserid->useruid+1;
            }
            else{
                $user->useruid         = 1001;
            }


            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->mobile       = $request->mobile;
            $user->password     = bcrypt($request->password);
            $user->role_id      = $request->role_id;

            $image = $request->image;

            if($image){
                $uniqname = uniqid();
                $ext = strtolower($image->getClientOriginalExtension());
                $filepath = 'public/images/users/';
                $imagename = $filepath.$uniqname.'.'.$ext;
                $image->move($filepath,$imagename);
                $user->image  = $imagename;
                
            }

            $user->type          = 1;
            $user->status        = $request->status;
            $user->save();

 
            $notification = array(
                'message' => 'User create Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('user.index')->with($notification);

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
         $data['roles'] = Role::all();
         $data['user'] = User::find($id);
         return view('backend.users.edit',$data);
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
         $validator = Validator::make($request->all(), [
            'role_id'   => 'required',
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'.$id,
            'mobile'    => 'required|numeric',
            'status'    => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $lastusercount = User::where('role_id',[1,2])->count();
            $lastuserid    = User::where('role_id',[1,2])->orderBy('id','DESC')->first();

            $user          = User::find($id);

             if($lastusercount>0)
            {
                $user->useruid         = $lastuserid->useruid+1;
            }
            else{
                $user->useruid         = 1001;
            }


            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->mobile       = $request->mobile;

            if($request->password)
            {
                $user->password = bcrypt($request->password);
            }

            $user->role_id      = $request->role_id;

            $image = $request->image;
            if($image){
                $uniqname = uniqid();
                $ext = strtolower($image->getClientOriginalExtension());
                $filepath = 'public/images/manpowers/';
                $imagename = $filepath.$uniqname.'.'.$ext;
                $image->move($filepath,$imagename);
                $user->image  = $imagename;
                
            }

            $user->type          = 1;
            $user->status        = $request->status;
            $user->save();

 
            $notification = array(
                'message' => 'User Update Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('user.index')->with($notification);

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
           $user         = User::find($id);
           $user->status = 0;
           $user->save();

            $notification   = array(
                'message'   => 'User delete Successfully!',
                'alert-type'=> 'success'
            );
            return redirect()->route('user.index')->with($notification);
    }




}
