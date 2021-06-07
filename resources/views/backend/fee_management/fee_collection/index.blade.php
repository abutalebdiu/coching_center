@extends('backend.layouts.app')
@section('title','Student collection List')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Student Fee Collection List  </h4>
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
                  
                    <a href="{{route('admin.fee-collection.create')}}" class="btn-primary btn float-right mb-1"> <i class="fa fa-plus"></i>Monthly Fee Collection </a>
                    <a href="{{route('admin.othersFeeCollection')}}" class="btn-primary btn float-right mb-1" style="margin-right:1%;"> <i class="fa fa-plus"></i>Others Fee Collection </a>
                    
                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <th class="text-nowrap">Student Name</th>
                                <th class="text-nowrap">Payment <br/> Invoice</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Session</th>
                                <th class="text-nowrap">Batch</th>
                                <th class="text-nowrap">Collection <br/> Month</th>
                                <th class="text-nowrap">Amount</th>
                                <th class="text-nowrap">Fee Category</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($collections as $collection)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{--  {{ $collection->user?$collection->user->name:NULL }}  --}}
                                        {{$collection->students?$collection->students->user?$collection->students->user->name:NULL:NULL}}
                                    </td>
                                    <td>
                                        {{ $collection->invoice_no }}
                                    </td>
                                    <td>
                                        {{ $collection->classes?$collection->classes->name:NULL }}
                                    </td>
                                    <td>
                                        {{ $collection->sessiones?$collection->sessiones->name:NULL }}
                                    </td>
                                    <td>
                                        {{ $collection->batchsetting?$collection->batchsetting->batch_name:NULL }}
                                    </td>
                                    <td>
                                        {{ $collection->months?$collection->months->name:NULL }}
                                    </td>
                                    <td>
                                        {{ $collection->amount }}
                                    </td>
                                    <td>
                                        {{$collection->feeCategores?$collection->feeCategores->name:NULL}}
                                    </td>
                                    <td>
                                        {{-- <a href="{{ route('admin.feeCollectionShow',$collection->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a> --}}
                                        {{--  <a href="{{ route('admin.feeCollectionEdit',$collection->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>  --}}
                                        {{-- <a href="{{route('admin.feeCollectionDestory',$collection->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a> --}}
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