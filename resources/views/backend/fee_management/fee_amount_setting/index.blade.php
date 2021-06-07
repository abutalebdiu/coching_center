@extends('backend.layouts.app')
@section('title','Fee Setting List')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Batch Wise Fee Amount Setting List  </h4>
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
                  
                    <a href="{{route('admin.fee-amount-setting.create')}}" class="btn-primary btn float-right mb-1"> <i class="fa fa-plus"></i> 
                        Add Batch Wise Fee Amount Setting 
                    </a>
                    
                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <th class="text-nowrap">Fee Category</th>
                                <th class="text-nowrap">Class </th>
                                <th class="text-nowrap">Session</th>
                                <th class="text-nowrap">Batch</th>
                                <th class="text-nowrap">Batch Type</th>
                                <th class="text-nowrap">Pay Time</th>
                                <th class="text-nowrap">Amount</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fee_settings as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->feeCategores?$item->feeCategores->name:NULL }}</td>
                                    <td>{{ $item->classes?$item->classes->name:NULL }}</td>
                                    <td>{{ $item->sessiones?$item->sessiones->name:NULL }}</td>
                                    <td>
                                         {{ $item->batchsetting?$item->batchsetting->batch_name:NULL }}
                                    </td>
                                    <td>{{ $item->batchTypes?$item->batchTypes->name:NULL }}</td>
                                    <td>{{ $item->payTypes?$item->payTypes->name:NULL }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>
                                        <a href="{{ route('admin.fee-amount-setting.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{route('admin.feeAmountSettingDestory',$item->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$fee_settings->links()}}
                </div>
            </div>
        </div>
        


@section('customjs')
    

    
    
@endsection
@endsection  