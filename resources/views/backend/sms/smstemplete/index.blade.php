@extends('backend.layouts.app')
@section('title','All SMS Templete')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">All SMS Templete  </h4>
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



                <a href="{{ route('sms_templete.create') }}" class="btn btn-primary btn-xs pull-right mb-2"> <i class="fa fa-plus"></i> Add New</a>

                <br>

                <table class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th width="70%">Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($SmsTemplates as $template)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $template->name }}</td>
                            <td>{{ $template->message }}</td>
                            <td>
                                @if($template->status==1)
                                <p class="btn btn-success btn-xs">Active</p>
                                @elseif($template->status==2)
                                <p class="btn btn-danger btn-xs">Deactive</p>
                                @endif
                            </td>
                             <td>



                            <div class="dropdown">
                                <button type="button" class="btn btn-xs  btn-primary dropdown-toggle" data-toggle="dropdown">
                                   <i class="fa fa-cogs"> </i> Action 
                                </button>
                                <div class="dropdown-menu">

                                 {{--    <a href="{{ route('sms_templete.edit', $template->id) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a> --}}
                                    <a href="{{ route('sms_templete.destroy',$template->id) }}" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>
                                    
                                    
                                </div>
                            </div>


                               
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
         </div>
    </div>












@endsection
