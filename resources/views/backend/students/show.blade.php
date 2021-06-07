@extends('backend.layouts.app')
@section('title','Show Student')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Show Student   </h4>
                    <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand">
                                <i class="fa fa-expand"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload">
                            <i class="fa fa-redo"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse">
                            <i class="fa fa-minus"></i>
                            </a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove">
                            <i class="fa fa-times"></i>
                            </a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="4">
                                Student Personal Information 

                                <a href="{{ route('admin.promotion-class.create','student_id='.$student->id) }}" class="btn btn-primary btn-sm pull-right">
                                    <i class="fa fa-check"></i> 
                                    Promotion
                                </a>
                            </th>
                        </tr>
                        <tr>
                            <th width="10%">Student ID</th>
                            <td width="40%">{{ $student->useruid }}</td>
                            <th width="10%">Name</th>
                            <td width="40%">{{ $student->name }}</td>
                        </tr>

                        <tr>
                            <th width="10%">Father Name</th>
                            <td width="40%">{{ $student->studentInfo?$student->studentinfo->father:'' }}</td>
                            <th width="10%">Mother</th>
                            <td width="40%">{{ $student->studentinfo?$student->studentinfo->mother:'' }}</td>
                        </tr>

                        <tr>
                            <th width="10%">Guardian Mobile</th>
                            <td width="40%">{{ $student->studentinfo?$student->studentinfo->guardian_mobile:'' }}</td>
                            <th width="10%">Own Mobile</th>
                            <td width="40%">{{ $student->studentinfo?$student->studentinfo->own_mobile:'' }}</td>
                        </tr>
                        <tr>
                            <th width="10%">Email</th>
                            <td width="40%">{{ $student->studentinfo?$student->studentinfo->email:'' }}</td>
                            <th width="10%">Whatsapp</th>
                            <td width="40%">{{ $student->studentinfo?$student->studentinfo->whatsapp_number:'' }}</td>
                        </tr>

                        <tr>
                            <th width="10%">facebook Id Link</th>
                            <td width="40%"> <a href="{{ $student->studentinfo?$student->studentinfo->facebook_id:'' }}" target="_blank">Facebook</a> </td>
                            <th width="10%">Bkash Number</th>
                            <td width="40%">{{ $student->studentinfo?$student->studentinfo->bkash_number:'' }}</td>
                        </tr>
                        <tr>
                            <th width="10%">Note</th>
                            <td width="40%">{{ $student->studentinfo?$student->studentinfo->notes:'' }} </td>
                            <th width="10%">Address</th>
                            <td width="40%">{{ $student->studentinfo?$student->studentinfo->address:'' }}</td>
                        </tr>
                        <tr>
                            <th width="10%">School Name</th>
                            <td width="40%"> {{ $student->students?$student->students->school_name:NULL }} </td>
                            <th width="10%">Status</th>
                            <td width="40%">
                                @if($student->studentinfo?$student->studentinfo->status:'' == 1)
                                <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($student->studentinfo?$student->studentinfo->status:'' == 2)
                                <p class="btn btn-warning btn-sm">Deactive</p>
                                @elseif($student->studentinfo?$student->studentinfo->status:'' == 0)
                                <p class="btn btn-danger btn-sm">Deleted</p>
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <th colspan="4">Academic Information</th>
                        </tr>
                        <tr>
                            <th>Class</th>
                            <td>{{ $student->students?$student->students->classes?$student->students->classes->name:NULL:NULL }}</td>
                            <th> Session</th>
                            <td>{{ $student->students?$student->students->sessiones?$student->students->sessiones->name:NULL:NULL }}</td>
                        </tr>
                        <tr>
                            <th>Batch</th>
                            <td>{{ $student->students?$student->students->batchsetting?$student->students->batchsetting->batch_name:NULL:NULL }}</td>
                            <th>Roll</th>
                            <td>{{ $student->students?$student->students->roll:NULL }}</td>
                        </tr>
                        <tr>
                            <th>Admission Date</th>
                            <td>{{ $student->students?$student->students->admission_date:NULL }}</td>

                            <th>Admission Month</th>
                            <td>{{ $student->students?$student->students->month?$student->students->month->name:NULL:NULL }}</td>
                        </tr>

                        <tr>
                            <th>Student Type</th>
                            <td>
                                {{ $student->students?$student->students->studentype?$student->students->studentype->name:NULL:NULL }}
                            </td>
                            <th width="10%">Status</th>
                            <td width="40%">
                                @if($student->students?$student->students->activate_status:NULL ==1)
                                <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($student->students?$student->students->activate_status:NULL ==2)
                                <p class="btn btn-warning btn-sm">Deactive</p>
                                @elseif($student->students?$student->students->activate_status:NULL ==0)
                                <p class="btn btn-danger btn-sm">Deleted</p>
                                @endif
                            </td>
                        </tr>



                    </table>
                </div>
            </div>
        </div>



@section('customjs')




@endsection
@endsection
