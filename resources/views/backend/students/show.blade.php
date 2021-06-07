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

                               {{--   <a href="{{ route('admin.promotion-class.create','student_id='.$student->user->id) }}" class="btn btn-primary btn-sm pull-right">
                                    <i class="fa fa-check"></i> 
                                    Promotion
                                </a>  --}}
                            </th>
                        </tr>
                        <tr>
                            <th width="10%">Student ID</th>
                            <td width="40%">{{ $student->user->useruid }}</td>
                            <th width="10%">Name</th>
                            <td width="40%">{{ $student->user->name }}</td>
                        </tr>

                        <tr>
                            <th width="10%">Father Name</th>
                            <td width="40%">{{ $student->user->studentInfo?$student->user->studentinfo->father:'' }}</td>
                            <th width="10%">Mother</th>
                            <td width="40%">{{ $student->user->studentinfo?$student->user->studentinfo->mother:'' }}</td>
                        </tr>

                        <tr>
                            <th width="10%">Guardian Mobile</th>
                            <td width="40%">{{ $student->user->studentinfo?$student->user->studentinfo->guardian_mobile:'' }}</td>
                            <th width="10%">Own Mobile</th>
                            <td width="40%">{{ $student->user->studentinfo?$student->user->studentinfo->own_mobile:'' }}</td>
                        </tr>
                        <tr>
                            <th width="10%">Email</th>
                            <td width="40%">{{ $student->user->studentinfo?$student->user->studentinfo->email:'' }}</td>
                            <th width="10%">Whatsapp</th>
                            <td width="40%">{{ $student->user->studentinfo?$student->user->studentinfo->whatsapp_number:'' }}</td>
                        </tr>

                        <tr>
                            <th width="10%">facebook Id Link</th>
                            <td width="40%"> <a href="{{ $student->user->studentinfo?$student->user->studentinfo->facebook_id:'' }}" target="_blank">Facebook</a> </td>
                            <th width="10%">Bkash Number</th>
                            <td width="40%">{{ $student->user->studentinfo?$student->user->studentinfo->bkash_number:'' }}</td>
                        </tr>
                        <tr>
                            <th width="10%">Note</th>
                            <td width="40%">{{ $student->user->studentinfo?$student->user->studentinfo->notes:'' }} </td>
                            <th width="10%">Address</th>
                            <td width="40%">{{ $student->user->studentinfo?$student->user->studentinfo->address:'' }}</td>
                        </tr>
                        <tr>
                            <th width="10%">School Name</th>
                            <td width="40%"> {{ $student->user->students?$student->user->students->school_name:NULL }} </td>
                            <th width="10%">Status</th>
                            <td width="40%">
                                @if($student->user->studentinfo?$student->user->studentinfo->status:'' == 1)
                                <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($student->user->studentinfo?$student->user->studentinfo->status:'' == 2)
                                <p class="btn btn-warning btn-sm">Deactive</p>
                                @elseif($student->user->studentinfo?$student->user->studentinfo->status:'' == 0)
                                <p class="btn btn-danger btn-sm">Deleted</p>
                                @endif
                            </td>
                        </tr>


                        <tr>
                            <th colspan="4">Academic Information</th>
                        </tr>
                        <tr>
                            <th>Class</th>
                            <td>{{ $student->classes?$student->classes->name:NULL }}</td>
                            <th> Session</th>
                            <td>{{ $student->sessiones?$student->sessiones->name:NULL }}</td>
                        </tr>
                        <tr>
                            <th>Batch</th>
                            <td>{{ $student->batchsetting?$student->batchsetting->batch_name:NULL }}</td>
                            <th>Batch Type</th>
                            <td>{{ $student->batchTypes?$student->batchTypes->name:NULL }}</td>
                        </tr>
                        <tr>
                            <th>Roll</th>
                            <td>{{ $student->roll }}</td>
                        </tr>
                        <tr>
                            <th>Admission Date</th>
                            <td>{{ $student->admission_date }}</td>

                            <th>Start Month</th>
                            <td>{{ $student->month?$student->month->name:NULL }}</td>
                        </tr>

                        <tr>
                            <th>Student Type</th>
                            <td>
                                {{ $student->studentype?$student->studentype->name:NULL }}
                            </td>
                            <th width="10%">Status</th>
                            <td width="40%">
                                @if($student->activate_status ==1)
                                <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($student->activate_status ==2)
                                <p class="btn btn-warning btn-sm">Deactive</p>
                                @elseif($student->activate_status ==0)
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
