@extends('backend.layouts.app')
@section('title','Sheet List')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Sheet List</h4>
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
                    <a href="{{ route('sheet.create') }}" class="btn btn-primary btn-xs pull-right mb-2"> <i class="fa fa-plus"></i> Add New Sheet</a>
                    <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="1%">SL</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Session</th>
                                <th class="text-nowrap">Batch</th>
                                <th class="text-nowrap">Payment Status</th>
                                <th class="text-nowrap">Amount</th>
                                <th class="text-nowrap">Published Date</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Created At</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                 	         
                 	    @foreach($sheets as  $sheet)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sheet->name }}</td>
                            <td>{{ $sheet->classes?$sheet->classes->name:'' }}</td>
                            <td>{{ $sheet->sessiones?$sheet->sessiones->name:'' }}</td>
                            <td>{{ $sheet->batchsetting?$sheet->batchsetting->batch_name:'' }}</td>
                            <td>
                                @if($sheet->free_for==1)
                                <p class="btn btn-primary btn-xs">Online Student</p>
                                @elseif($sheet->free_for==2)
                                <p class="btn btn-primary btn-xs">Office Student</p>
                                @elseif($sheet->free_for==3)
                                <p class="btn btn-primary btn-xs">Both</p>
                                @elseif($sheet->free_for==4)
                                 <p class="btn btn-primary btn-xs">Paid</p>
                                @endif

                            </td>
                            <td>{{ $sheet->amount }}</td>
                            <td>{{ Date('d-M-Y',strtotime($sheet->publish_date)) }}</td>
                              
                            <td>
                            	@if($sheet->status==1)
                            	<p class="btn btn-primary btn-xs">Active</p>
                            	@elseif($sheet->status==2)
                            	<p class="btn btn-danger btn-xs">Deactive</p>
                            	@endif
                            </td>
                              <td>{{ $sheet->created_at->format('d-M-Y H:s A') }}</td>
                            <td>
                                <a href="{{ route('sheet.edit', $sheet->id) }}" class="btn btn-xs btn-success">
                            		<i class="fa fa-edit"></i> Edit
                            	</a> 
                            	 
                            	<a href="{{ route('sheet.destroy',$sheet->id) }}" id="delete" class="btn btn-xs btn-danger">
                            		<i class="fa fa-times"></i> Delete
                            	</a>
                            </td>
                        </tr>
                               
                        @endforeach
                             
                             
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        


@section('customjs')


@endsection
@endsection