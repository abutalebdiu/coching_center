@extends('backend.layouts.app')
@section('title','Batch Schedule')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Batch Schedule List</h4>
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
                    <a class="btn btn-primary btn-sm pull-right" href="{{ route('batch.schedule.create') }}">Add New Batch</a>
                    <br>
                    <br>
                    <table class="table table-bordered table-hovered">
                        <tr>
                            <th>Sl</th>
                            <th>Batch ID</th>
                            <th>Batch Name</th>
                            <th>Class </th>
                            <th>Session</th>
                            <th>Batch</th>
                            <th>Class Type</th>
                            <th>Day</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach($batchsettings as $setting)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $setting->batch_uid }}</td>
                            <td>{{ $setting->batch_name }}</td>
                            <td>{{ $setting->classes?$setting->classes->name:'' }}</td>
                            <td>{{ $setting->sessiones?$setting->sessiones->name:'' }}</td>
                            <td>{{ $setting->batch?$setting->batch->name:'' }}</td>
                            <td>{{ $setting->classtype?$setting->classtype->name:'' }}</td>
                            <td>
                                @foreach($setting->dayandtime as $daytime)
                                <p>{{ $daytime->day?$daytime->day->name:'' }} - {{ $daytime->start_time }} - {{ $daytime->end_time }}</p>
                                @endforeach
                            </td>
                            <td>
                                @if($setting->status==1)
                                <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($setting->status==2)
                                <p class="btn btn-danger btn-sm">Deactive</p>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('batch.schedule.edit',$setting->id) }}"> <i class="fa fa-edit"></i> Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('batch.schedule.destroy',$setting->id) }}"> <i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>


                        @endforeach

                    </table>

                </div>
            </div>
        </div>



@section('customjs')


@endsection
@endsection
