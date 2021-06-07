<?php

namespace App\Http\Controllers\Backend\Sheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sheet;
use Auth;
use App\Models\Sessiones;
use App\Models\Classes;
use App\Models\BatchSetting;
use Validator;
use Carbon\Carbon;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['sheets'] = Sheet::orderBy('id','DESC')->where('status',1)->get();
        return view('backend.sheet.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['classes']    = Classes::all();
         $data['sessiones']  = Sessiones::all();
         return view('backend.sheet.add',$data);
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
            'name'          => 'required',
            'classes_id'    => 'required',
            'sessiones_id'  => 'required',
            'batch_setting_id'=> 'required',
            'sheet_file'    => 'required',
            'free_for'      => 'required',
            'status'        => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        } 
        else{

            $sheet = New Sheet();


            $sheet->name                = $request->name;
            $sheet->classes_id          = $request->classes_id;
            $sheet->sessiones_id        = $request->sessiones_id;
            $sheet->batch_setting_id    = $request->batch_setting_id;
            $sheet->free_for            = $request->free_for;
            $sheet->amount              = $request->amount;

            $sheet_file                 = $request->sheet_file;

            if($sheet_file){
                $uniqname   = uniqid();
                $ext        = strtolower($sheet_file->getClientOriginalExtension());
                $filepath   = 'public/uploads/';
                $imagename  = $filepath.$uniqname.'.'.$ext;
                $sheet_file->move($filepath,$imagename);
                $sheet->sheet_file= $imagename; 
            }

            if($sheet->publish_date)
            {

                $sheet->publish_date = $request->publish_date;
            }
            else{
                $sheet->publish_date = Carbon::now();
            }   

            $sheet->download_times  = 0;
            $sheet->status          = $request->status;
            $sheet->user_id         = Auth::user()->id;

            $sheet->save();


        $notification = array(
            'message' => 'Sheet Successfully Added!',
            'alert-type' => 'success'
        );

        return redirect()->route('sheet.index')->with($notification);




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
        $data['classes']    = Classes::all();
        $data['sessiones']  = Sessiones::all();
        $data['sheet'] = Sheet::find($id);

        return view('backend.sheet.edit',$data);
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
            'name'          => 'required',
            'classes_id'    => 'required',
            'sessiones_id'  => 'required',
            'batch_setting_id'=> 'required',
            'free_for'      => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        } 
        else{

            $sheet =  Sheet::find($id);


            $sheet->name                = $request->name;
            $sheet->classes_id          = $request->classes_id;
            $sheet->sessiones_id        = $request->sessiones_id;
            $sheet->batch_setting_id    = $request->batch_setting_id;
            $sheet->free_for            = $request->free_for;
            $sheet->amount              = $request->amount;

            $sheet_file                 = $request->sheet_file;

            if($sheet_file){
                $uniqname   = uniqid();
                $ext        = strtolower($sheet_file->getClientOriginalExtension());
                $filepath   = 'public/uploads/';
                $imagename  = $filepath.$uniqname.'.'.$ext;
                $sheet_file->move($filepath,$imagename);
                $sheet->sheet_file= $imagename; 
            }

            if($sheet->publish_date)
            {

                $sheet->publish_date = $request->publish_date;
            }
            else{
                $sheet->publish_date = Carbon::now();
            }   

            $sheet->download_times  = 0;
            $sheet->status          = $request->status;
            
            $sheet->save();


        $notification = array(
            'message' => 'Sheet Successfully Updated!',
            'alert-type' => 'success'
        );

        return redirect()->route('sheet.index')->with($notification);




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
         $sheet = Sheet::find($id);
         $sheet->status = 0;
         $sheet->save();

        $notification = array(
            'message' => 'Sheet Successfully Deleted!',
            'alert-type' => 'success'
        );

        return redirect()->route('sheet.index')->with($notification);
    }
}
