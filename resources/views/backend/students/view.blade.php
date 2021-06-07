@extends('backend.layouts.app')
@section('title','Student list')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Student list  </h4>
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

                    <a href="{{ route('student.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-batch"><i class="fa fa-plus"></i> Add New Student</a>

                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <td>Student ID</td>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Session</th>
                                <th class="text-nowrap">Batch</th>
                                <th class="text-nowrap">Batch Type</th>
                                <th class="text-nowrap">Roll</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach($allstudents as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->user?$student->user->useruid:NULL }}</td>
                                    <td>{{ $student->user?$student->user->name:NULL }}</td>
                                    <td>{{ $student->classes?$student->classes->name:NULL }}</td>
                                    <td>{{ $student->sessiones?$student->sessiones->name:NULL }}</td>
                                    <td>
                                        {{ $student->batchsetting?$student->batchsetting->batch_name:NULL }}
                                    </td>
                                    <td>
                                        {{ $student->batchTypes?$student->batchTypes->name:NULL }}
                                    </td>

                                    <td>{{ $student->roll }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-xs  btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <small> Action </small>
                                            </button>
                                            <div class="dropdown-menu">

                                                <a href="{{ route('student.edit',$student->id) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                                                <a href="{{ route('student.show',$student->id) }}" class="dropdown-item"><i class="fa fa-eye"></i> Show</a>
                                                {{-- <a href="{{ route('student.destroy',$student->id) }}" id="delete" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a> --}}

                                                {{--  <a href="{{ route('admin.promotion-class.create','student_id='.$student->user_id) }}" class="dropdown-item">
                                                    <i class="fa fa-check"></i>
                                                    Promotion
                                                </a>  --}}

                                                {{-- <a href="{{ route('admin.student-waiver.create','student_id='.$student->user_id) }}" class="dropdown-item">
                                                    <i class="fa fa-check"></i>
                                                    Waiver
                                                </a>
                                                <a href="{{ route('admin.absent.create','student_id='.$student->user_id) }}" class="dropdown-item">
                                                    <i class="fa fa-check"></i>
                                                    Absent
                                                </a>
                                                @php
                                                    $class_id =  $student->class_id;
                                                    $session_id= $student->session_id;
                                                    $batch_id = $student->section_id;
                                                    $class_type_id = $student->student_type_id;
                                                    $makeurl = 'student_id='.$student->user_id . '&session_id='.$session_id.'&class_id='.$class_id.'&batch_id='.$batch_id.'&class_type_id='.$class_type_id;
                                                @endphp
                                                <a href="{{ route('admin.fee-collection.create',$makeurl ) }}"class="dropdown-item">
                                                    <i class="fa fa-check"></i>
                                                    Fee Collection
                                                </a> --}}

                                               {{--   <a href="" class="dropdown-item">
                                                    <i class="fa fa-check"></i>
                                                    Change Batch
                                                </a>
                                                <a href="{{route('admin.new-batch.create','student_id='.$student->user_id)}}" class="dropdown-item">
                                                    <i class="fa fa-check"></i>
                                                    Add New Batch
                                                </a>
                                                <a href="" class="dropdown-item">
                                                    <i class="fa fa-check"></i>
                                                    Add Coupon
                                                </a>  --}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>



                            @endforeach

                        </tbody>
                    </table>
                    {{$allstudents->links()}}
                </div>
            </div>
        </div>



@section('customjs')




@endsection
@endsection
