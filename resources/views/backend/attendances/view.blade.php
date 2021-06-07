@extends('backend.layouts.app')
@section('title','SMS Report')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">SMS Report  </h4>
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
                 <table class="table table-hovered table-bordered">
                     <thead>
                         <tr>
                             <th>Serial</th>
                             <th>Date</th>
                             <th>Class</th>
                             <th>Session</th>
                             <th>Batch</th>
                             <th>Total Student</th>
                             <th>Total Present</th>
                             <th>Total Absent</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                        @foreach($attendances as $attendance)
                         <tr>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ $attendance->classes->name }}</td>
                             <td>{{ $attendance->sessiones->name }}</td>
                             <td>{!! $attendance->batchsetting->batch_name !!}</td>
                             <td>{!! $attendance->attendance_date !!}</td>
                             <td>{{ $attendance->total_student }}</td>
                             <td>{{ $attendance->total_present }}</td>
                             <td>{{ $attendance->total_absent }}</td>
  
                             <td>
                                 <a href="" class="btn btn-primary btn-sm"><i class="fa fa-edit"> Edit</i></a>
                             </td>
                         </tr>
                        @endforeach
                     </tbody>
                 </table>
            </div>
        </div>
    </div>

@endsection
