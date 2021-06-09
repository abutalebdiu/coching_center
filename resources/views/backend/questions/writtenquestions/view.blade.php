@extends('backend.layouts.app')
@section('title','Written Questions')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Written Questions  </h4>
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

                <a href="{{ route('written.question.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add Written Question</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Serial No</th>
                        <th class="text-nowrap">Question No/Name</th>
                        <th class="text-nowrap">Subject Name</th>
                        <th class="text-nowrap">Class</th>
                        <th class="text-nowrap">Session</th>
                        <th class="text-nowrap">Examination Type</th>
                        <th class="text-nowrap">Question</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($writtenquestiones as $question)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $question->question_no }}</td>
                            <td>{{ $question->subject?$question->subject->name:'' }}</td>
                            <td>{{ $question->classes?$question->classes->name:'' }}</td>
                            <td>{{ $question->sessiones?$question->sessiones->name:'' }}</td>
                            <td>{{ $question->ExamTypies?$question->ExamTypies->name:'' }}</td>
                            <td>
                                <a href="{{ asset($question->attachment) }}" download="" class="btn btn-primary btn-sm">Download</a>
                            </td>
                            <td>
                                 @if($question->status==1)
                                    <span class="btn btn-primary btn-sm">Active</span>
                                @elseif($question->status==2)
                                    <span class="btn btn-danger btn-sm">inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('written.question.edit',$question->id) }}" class="btn btn-primary btn-sm"> Edit</a>
                                <a href="{{ route('admin.written-setting.create','qid='.$question->id) }}" class="btn btn-primary btn-sm"> Setting</a>
                                <a href="{{ route('written.question.destroy',$question->id) }}" class="btn btn-danger btn-sm"> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$writtenquestiones->links()}}
            </div>





        </div>
    </div>

@endsection
