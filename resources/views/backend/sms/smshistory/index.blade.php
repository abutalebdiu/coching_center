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
                             <th>Student ID</th>
                             <th>Student Name</th>
                             <th>Student Message</th>
                             <th>Status</th>
                         </tr>
                     </thead>
                     <tbody>
                        @foreach($smshistories as $smshistory)
                         <tr>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ $smshistory->user?$smshistory->user->useruid:'' }}</td>
                             <td>{{ $smshistory->user?$smshistory->user->name:'' }}</td>
                             <td>{!! $smshistory->message !!}</td>
                             <td>
                                 @if($smshistory->status==1)
                                 <p class="btn btn-primary btn-sm">Delivery</p>
                                 @elseif($smshistory->status==2)
                                 <p class="btn btn-danger btn-sm">Failded</p>
                                 @endif
                             </td>
                         </tr>
                        @endforeach
                     </tbody>
                 </table>
            </div>
        </div>
    </div>

@endsection
