@extends('backend.layouts.app')
@section('title','Add Student Absent')


    @push('css')
    <link href="{{ asset('public/backend') }}/multi-selector/css/fselector.css" rel="stylesheet" /> 
    <script src="{{ asset('public/backend') }}/multi-selector/js/jquery.js"></script>
    <script src="{{ asset('public/backend') }}/multi-selector/js/fselector.js"></script>
        <script>
        (function($) {
            $(function() {
                $('.test').fSelect();
            });
        })(jQuery);
        </script>
    @endpush
@section('content')



            <div id="content" class="content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                        <div class="panel-heading">
                            <h4 class="panel-title">Add Student Absent</h4>
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
                            <form action="{{ route('admin.absent.store') }}" method="POST" >
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Student Name</label>
                                                <select name="student_id" id="" class=" student_id form-control" required >
                                                    <option value="">Select Student</option>
                                                    @foreach($students as $student)
                                                    <option {{ $get_student_id ==  $student->id ? 'selected' : ''  }} {{ old('student_id') == $student->id ? 'selected' : '' }} value="{{ $student->id }}">
                                                        {{ $student->user?$student->user->name:NULL }}
                                                         ({{ $student->user?$student->user->mobile:NULL }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Batch Name</label>
                                                <input type="text" disabled class="batch_setting_id form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="" >Class</label>
                                                <input type="text" disabled class="class_id form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Session</label>
                                                <input type="text" disabled class="session_id form-control" />
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Class Type </label>
                                                <input type="text" disabled class="class_type_id form-control" />
                                            </div>
                                        </div>

                                    </div><!---- child row in a row end--->

                                    </div><!---- col-md-6 end--->

                                    <div class="col-md-6">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Month (<small>Current Year - {{date('Y')}}</small>) </label>
                                                <select name="month_id[]" id="" class="test start_month_id form-control" multiple="multiple" required>
                                                    <option value="">Select Start Month</option>
                                                    @foreach($months as $month)
                                                    <option {{ old('start_month_id') == $month->id ? 'selected' : '' }} value="{{ $month->id }}">
                                                        {{ $month->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Reason </label>
                                                <input type="text"  name="reason" value=""  class="form-control "/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Note </label>
                                                <input type="text"  name="note" value=""  class="form-control "/>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Status</label>
                                                <select name="status" id="" class="form-control" required>
                                                    <option value="">Select Status</option>
                                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                                    <option {{ old('status') == 2 ? 'selected' : '' }} value="2">Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="col-md-12"></div>
                                        <div class="hidden_div"></div>
                                        <input type="hidden"  value="{{$get_student_id}}" />
                                        <input type="hidden" name="user_id" value="{{$student_user_id}}" class="user_id" />

                                    </div><!---- child row in a row end--->
                                    </div><!---- col-md-6 end--->

                                </div>
                                <!----div row end--->



                                    <input type="submit" value="Submit" class="submitButton btn btn-md btn-primary  pull-right" disabled style="margin-left:1%;">
                                    <a  class="btn btn-md btn-danger pull-right" href="{{ route('admin.absent.index') }}">Cancel</a>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>













@section('customjs')

    <script>
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });



        $(document).ready(function(){
            $('.submitButton').attr('disabled','disabled');
            getStudentCurrentData();
        });
        $(document).on('change','.student_id',function(){
            $('.submitButton').attr('disabled','disabled');
            getStudentCurrentData();
        });

        function getStudentCurrentData()
        {   
            var student_id  = $('.student_id option:selected').val();
            $.ajax({
                    type: "get",
                    url: "{{ route('admin.getWaiverStudentDataByStudentId') }}",
                    data: {student_id:student_id},
                    success: function (data) {
                        if(data.status == true)
                        {
                            $('.class_id').val(data.class);
                            $('.session_id').val(data.session);
                            $('.batch_setting_id').val(data.batch_setting);
                            $('.class_type_id').val(data.Class_type);
                            $('.user_id').val(data.user_id);
                            $(".hidden_div").html(data.hidden);
                            $('.submitButton').removeAttr('disabled','disabled');
                        }else{
                            $('.class_id').val('');
                            $('.session_id').val('');
                            $('.batch_setting_id').val('');
                            $('.class_type_id').val('');
                            $('.user_id').val('');
                            $(".hidden_div").html('');
                            $('.submitButton').attr('disabled','disabled');
                        }
                    },
                    error: function (data) {

                    }
                });
        }

        function nanCheck(val)
        {
            var total = val;
            if(isNaN(val)) {
                var total = 0;
            }
            return total;
        }

    </script>


@endsection
@endsection
