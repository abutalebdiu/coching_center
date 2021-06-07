<?php

namespace App\Http\Controllers\Backend\SMS;

use App\Http\Controllers\Controller;
use App\Models\SmsHistroy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SmsHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $data['smshistories'] = SmsHistroy::latest()->get();
        return view('backend.sms.smshistory.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sms.smshistory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'status' => 'required'
        ]);

        $sms_historys = new SmsHistory();
        $sms_historys->user_id = Auth::user(id);
        $sms_historys->message = $request->message;
        $sms_historys->status = $request->status;
        $sms_historys->save();


        $notification = array(
            'message' => 'Sms History Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('sms_history.index')->with($notification);
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
