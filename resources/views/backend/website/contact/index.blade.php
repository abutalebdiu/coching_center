@extends('backend.layouts.app')
@section('title','blog')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Class  </h4>
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

                <a href="javascript:void(0)" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add blog</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">serial no</th>
                        <th class="text-nowrap">id</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Mobile Number</th>
                        <th class="text-nowrap">Email</th>
                        <th class="text-nowrap">Subject</th>
                        <th class="text-nowrap">Message</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($contacts as $contact)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$contact->name }}</td>
                            <td>{{$contact->mobile }}</td>
                            <td>{{$contact->email }}</td>
                            <td>{{$contact->subject }}</td>
                            <td>{{$contact->message }}</td>

                            <td>
                                @if($contact->status==1)
                                    <p class="btn btn-primary">Active</p>
                                @elseif($contact->status==2)
                                    <p class="btn btn-danger">inactive</p>
                                @endif
                            </td>

                            <td>
                                <a href="{{route('contact.show',$contact->id)}}" class="btn btn-success">view</a>
                                <a href="{{route('contact.edit',$contact->id)}}" class="btn btn-primary">edit</a>
                                <a href="{{route('contact.destroy',$contact->id)}}" id="delete" class="btn btn-danger">delate</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>



            {{--  =============  for add new class ========================== --}}

            <div class="modal fade" id="ajax-class-modal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modeltitle"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="classForm" name="classForm" class="form-horizontal">
                                <input type="hidden" name="class_id" id="class_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Class</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"  value="" placeholder="Enter class name" required="">
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>









            {{--  =============  for add new class ========================== --}}







        </div>
    </div>

@endsection
