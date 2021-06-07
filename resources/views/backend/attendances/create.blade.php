@extends('backend.layouts.app')
@section('title','Add New Student')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add New Student  </h4>
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


                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        @if(is_array(session('error')))
                            <ul>
                                @foreach (session('error') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ session('error') }}
                        @endif
                    </div>
                    @endif


                <form action="" method="get" enctype="multipart/form-data">
                   
                    <div class="row">
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id" id="class_id" class="class_id form-control" >
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option {{ old('class_id') == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <select name="session_id" id="session_id" class="session_id form-control" >
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option {{ old('session_id') == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="Batch Setting">Batch  :</label>
                                <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control" >
                                     <option  value="">Select Batch</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>
 
                        
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="">Student Type</label>
                                <select name="student_type_id" id="student_type_id" class="student_type_id form-control" >
                                     <option value="">Select Student Type</option>
                                  
                                </select>
                                 <div class="text-danger">{{ $errors->first('student_type_id') }}</div>
                            </div>
                        </div> 
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="">Date of Attendance</label>
                                <input type="date" name="attendance_date" class="form-control" value="{{ old('attendance_date') }}">
                                 <div class="text-danger">{{ $errors->first('attendance_date') }}</div>
                            </div>
                        </div>





                        <div class="col-xs-12 col-sm-2 col-md-2">
                        	<div class="form-group mb-3">

                                 <button type="submit" class="btn btn-primary mt-3"> <i class="fa fa-search"></i> Search</button>
                        	</div>
                        </div>
                    </div>
                </form>

                @if($datacount>0)
                <div class="row">

                	<div class="col-md-12">
                		<h4>Student Attendance</h4>
                	</div>
                	<div class="col-md-12">
                		<form action="{{ route('student.attendance.store') }}" method="post">
                			@csrf
		                	<div class="table-responsive">
			                	<table class="table table-hovered table-bordered">
			                		<tr>
			                			<th>Action</th>
			                			<th>Student ID</th>
			                			<th>Name</th>
			                			<th>Roll</th>
			                		 
			                		</tr>

			                		@foreach($students as $student)
			                		 <tr>
			                		 	<th>
			                		 		<input type="hidden" value="{{ $class_id }}" name="classes_id">
			                		 		<input type="hidden" value="{{ $session_id }}" name="sessiones_id">
			                		 		<input type="hidden" value="{{ $batch_setting_id }}" name="batch_setting_id">
			                		 		<input type="hidden" value="{{ $attendance_date }}" name="attendance_date">
			                		 		<select name="attendance[]" id="" class="form-control">
			                		 			<option value="Present">Present</option>
			                		 			<option value="Absent">Absent</option>
			                		 		</select>
			                		 		<input type="hidden" value="{{ $student->user_id }}" name="student[]">
			                		 	</th>
			                		 	<th>{{ $student->user?$student->user->useruid:'' }}</th>
			                		 	<th>{{ $student->user?$student->user->name:'' }}</th>
			                		 	<th>{{ $student->user?$student->roll:'' }}</th>
			                		 </tr>
			                		@endforeach
			                	</table>

			                	<button class="btn btn-primary btn-sm">Submit</button>
		                	</div>
                		</form>
				</div>

                </div>	
                @endif










            </div>









        </div>
    </div>







@section('customjs')

    <script>
        $(document).ready( function () {
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

        $(document).ready(function(){
            getBatchSetting();
            getClassType();
        });

         $(document).on('change','.class_id ,.session_id', function () {
              getBatchSetting();
        });

        function getBatchSetting()
        {
            var class_id    = $('.class_id').val();
              var session_id  = $('.session_id').val();
                if(class_id && session_id)
                {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get.batch.setting') }}",
                        data: {class_id:class_id,session_id:session_id},
                        success: function (data) {
                            if(data.status == true)
                            {
                                $(".batch_setting_id").html(data.batch_setting);
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
        }



        $(document).on('change','.batch_setting_id,.class_id ,.session_id', function () {
            getClassType();
        });

            function getClassType()
            {
                var class_id          = $('.class_id').val();
                var session_id        = $('.session_id').val();
                var batch_setting_id  = $('.batch_setting_id').val();
                if(class_id && session_id)
                {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get_class_type_by_batch_setting') }}",
                        data: {class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id},
                        success: function (data) {
                            if(data.status == true)
                            {
                                $(".student_type_id").html(data.class_type);
                            }else{
                                $(".student_type_id").html(data.class_type);
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            }
            
        });
    </script>


@endsection
@endsection
