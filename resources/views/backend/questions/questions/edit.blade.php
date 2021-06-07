@extends('backend.layouts.app')
@section('title','blog')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Old Question  </h4>
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
                <form action="{{ route('old_question.update',$old_qus->id) }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    <div class="form-group">
                        <label for="question">Question Type :</label>
                        <select name="question_type_id" id="question" class="form-control">
                            <option value="">Select Question Type</option>
                            @foreach($question_types as $question_type)
                                <option  {{$old_qus->question_type_id == $question_type->id ? 'selected' : '' }} value="{{$question_type->id}}">{{$question_type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="school">School Name :</label>
                        <input type="text" name="schoolname" value="{{ $old_qus->schoolname}}" id="school" class="form-control" placeholder="Enter School Name">

                    </div>

                    <div class="form-group">
                        <label for="year_id">Year :</label>
                        <select name="year_id" id="year_id" class="form-control">
                            @foreach($years as $year)
                                <option  {{$old_qus->year_id == $year->id ? 'selected' : '' }} value="{{$year->id}}">{{$year->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class">Class :</label>
                        <select name="class_id" id="class" class="form-control">
                            @foreach($classs as $classes)
                                <option  {{$old_qus->class_id == $classes->id ? 'selected' : '' }} value="{{$classes->id}}">{{$classes->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="class">Exam Type</label>
                        <select name="exam_type_id" id="class" class="form-control">
                            @foreach($exams as $exam)
                                <option  {{$old_qus->exam_type_id == $exam->id ? 'selected' : '' }} value="{{$exam->id}}">{{$exam->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject_code">Subject :</label>
                        <select name="subject_id" id="subject_code" class="form-control">
                            @foreach($subjects as $subject)
                                <option  {{$old_qus->subject_id == $subject->id ? 'selected' : '' }} value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="board_question_type">Board Questin Type :</label>
                        <select name="board_question_type_id" id="subject_code" class="form-control">
                            @foreach($board_questions as $board_question)
                                <option  {{$old_qus->board_question_type_id == $board_question->id ? 'selected' : '' }} value="{{$board_question->id}}">{{$board_question->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Question File :</label>
                        <input type="file" class="form-control" name="questionfile">
                        @error('questionfile')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option  {{ $old_qus->status==1 ? 'selected' : ''}} value="1">active</option>
                            <option  {{ $old_qus->status==2 ? 'selected' : '' }} value="2">inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>

                </form>
            </div>









        </div>
    </div>

@endsection
