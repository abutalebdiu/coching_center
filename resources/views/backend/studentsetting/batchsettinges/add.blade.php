    @extends('backend.layouts.app')
    @section('title','Add New Batch Schedule')
    @section('content')



                <div id="content" class="content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                            <div class="panel-heading">
                                <h4 class="panel-title">Add New Batch Schedule</h4>
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
                                <form action="{{ route('batch.schedule.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-6">

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Batch Name</label>
                                                    <input type="text" class="form-control" name="batch_name" value="{{ old('batch_name') }}" placeholder="Enter Batch Schedule Name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="" >Class</label>
                                                    <select name="classes_id" id="" class="form-control" required>
                                                        <option value="">Select Class</option>
                                                        @foreach($classes as $class)
                                                        <option {{ old('classes_id') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Session</label>
                                                    <select name="sessiones_id" id="" class="form-control" required>
                                                        <option value="">Select Session</option>
                                                        @foreach($sessiones as $session)
                                                        <option {{ old('sessiones_id') == $session->id ? 'selected' : '' }} value="{{ $session->id }}">{{ $session->name }}</option>
                                                        @endforeach
                                                </select>
                                                </div>
                                            </div>

                                        </div><!---- child row in a row end--->

                                        </div><!---- col-md-6 end--->

                                        <div class="col-md-6">
                                            <div class="row">

                                                <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Batch</label>
                                                    <select name="batch_id" id="" class="form-control" >
                                                        <option value="">Select Batch</option>
                                                        @foreach($batches as $batch)
                                                        <option {{ old('batch_id') == $batch->id ? 'selected' : '' }} value="{{ $batch->id }}">{{ $batch->name }}</option>
                                                        @endforeach
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Class Type </label>
                                                    <select name="class_type_id" id="" class="form-control" required>
                                                            <option value="">Select Class Type</option>
                                                            @foreach($classtypes as $classtype)
                                                            <option {{ old('class_type_id') == $classtype->id ? 'selected' : '' }} value="{{ $classtype->id }}">{{ $classtype->name }}</option>
                                                            @endforeach
                                                    </select>
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
                                                {{-- <div class="col-md-12">

                                                    <table class="table table-bordered table-hovered">
                                                        <tr>
                                                        <th>Sl</th>
                                                        <th>Fee Category</th>
                                                        <th>Amount</th>
                                                        </tr>
                                                        @foreach($fee_categories as $feeCat)
                                                        <tr>
                                                        <td style="width:15%;">
                                                            <span style="margin-right:8px;font-size:15px;">{{ $loop->iteration }}.</span>
                                                            <input type="checkbox" name="fee_cat_id[]" id="checked_id_{{$feeCat->id}}" value="NULL" style="padding:10%;display:none;" data-check_id="{{$feeCat->id}}" class="check_class"/>
                                                        </td>
                                                        <td style="width:55%;">
                                                            {{ $feeCat->name }}
                                                        </td>
                                                        <td style="width:30%;">
                                                            <input type="number" name="amount[]" value="" data-id="{{$feeCat->id}}" id="checked_amount_id_{{$feeCat->id}}" class="type form-control" />
                                                            <input type="hidden" name="id[]" value="" id="ids_{{$feeCat->id}}" />
                                                        </td>
                                                        </tr>
                                                        @endforeach

                                                </table>
                                                </div>--}}

                                            </div><!---- child row in a row end--->
                                        </div><!---- col-md-6 end--->

                                    </div>
                                    <!----div row end--->



                                    {{--
                                        <div class="form-group row">
                                        <div class="col-md-6">
                                        <label class="col-md-12">Batch Name</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control" name="batch_name" value="{{ old('batch_name') }}" placeholder="Enter Batch Schedule Name">
                                        </div>
                                        </div>
                                        </div>
                                        <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="" class="col-md-12">Class</label>
                                                    <div class="col-md-12">
                                                    <select name="classes_id" id="" class="form-control" required>
                                                            <option value="">Select Class</option>
                                                            @foreach($classes as $class)
                                                            <option {{ old('classes_id') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                            @endforeach
                                                    </select>
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="col-md-12">Session</label>
                                                <div class="col-md-12">
                                                    <select name="sessiones_id" id="" class="form-control" required>
                                                        <option value="">Select Session</option>
                                                        @foreach($sessiones as $session)
                                                        <option {{ old('sessiones_id') == $session->id ? 'selected' : '' }} value="{{ $session->id }}">{{ $session->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="" class="col-md-12">Batch</label>
                                                <div class="col-md-12">
                                                    <select name="batch_id" id="" class="form-control" required>
                                                        <option value="">Select Batch</option>
                                                        @foreach($batches as $batch)
                                                        <option {{ old('batch_id') == $batch->id ? 'selected' : '' }} value="{{ $batch->id }}">{{ $batch->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="col-md-12">Class Type</label>
                                                <div class="col-md-12">
                                                    <select name="class_type_id" id="" class="form-control" required>
                                                        <option value="">Select Class Type</option>
                                                        @foreach($classtypes as $classtype)
                                                        <option {{ old('class_type_id') == $classtype->id ? 'selected' : '' }} value="{{ $classtype->id }}">{{ $classtype->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="" class="col-md-12">Batch Fee</label>
                                                <div class="col-md-12">
                                                    <input type="text" name="amount" value="0" placeholder="Enter Batch Amount" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="" class="col-md-12">Status</label>
                                                <div class="col-md-12">
                                                    <select name="status" id="" class="form-control" required>
                                                        <option value="">Select Status</option>
                                                        <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                                        <option {{ old('status') == 2 ? 'selected' : '' }} value="2">Deactive</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    --}}


                                    <hr>



                                        <div class="row">
                                            <div class="col-md-12">
                                                <span class="adddaytime help-block btn btn-primary btn-sm pull-right"><i class="fa fa-plus"></i> Add Day </span>
                                            </div>
                                        </div>


                                        <div class='form-group row'>
                                        <div class='col-md-4'>
                                            <label for='' class='col-md-12'>Day</label>
                                            <div class='col-md-12'>
                                                <select name='day_id[]' id='' class='form-control' required>
                                                        <option value=''>Select Day</option>
                                                        @foreach($daies as $day)
                                                        <option {{ old('day_id') == $day->id ? 'selected' : '' }} value='{{ $day->id }}'>{{ $day->name }}</option>
                                                        @endforeach

                                                </select>
                                            </div>
                                        </div>
                                            <div class='col-md-4'>
                                            <label for="" class='col-md-12'>Start Time</label>
                                            <div class="col-md-12">
                                                <input type='time' class='form-control' name='start_time[]' value='{{ old('start_time') }}'>
                                            </div>
                                        </div>

                                        <div class='col-md-4'>
                                            <label for='' class='col-md-12'>End Time</label>
                                            <div class='col-md-12'>
                                                <input type='time' class='form-control' name='end_time[]' value='{{ old('end_time') }}'>
                                            </div>
                                        </div>
                                        </div>

                                        <span class="containerdaytime">

                                        </span>


                                        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
                                        <a  class="btn btn-sm btn-default" href="{{ route('batch.schedule.index') }}">Cancel</a>

                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>













    @section('customjs')

    <script>
        $(document).on('keyup','.type',function(){
            var id = $(this).data('id');
            var amount = nanCheck($('#checked_amount_id_'+id).val());
            if(amount)
            {
                $('#checked_id_'+id).prop('checked', true);
                $('#checked_id_'+id).val(id);
                $('#checked_id_'+id).show();
                $('#ids_'+id).val(id);
            }else{
                $('#checked_id_'+id).prop('checked', false);
                $('#checked_id_'+id).val('NULL');
                $('#checked_id_'+id).hide();
                $('#ids_'+id).val('');
            }
        })

        $(document).on('click','.check_class',function(){
            var check_id   = $(this).data('check_id');
            var checkValue = $('#checked_amount_id_'+check_id).val();

            if ($(this).is(':checked'))
            {
                $('#checked_id_'+check_id).val(check_id);
                $('#checked_amount_id_'+check_id).val(checkValue);
                $('#ids_'+check_id).val(check_id);
            }
            else{
                $('#checked_id_'+check_id).val('NULL');
                $('#checked_amount_id_'+check_id).val('');
                $('#checked_id_'+check_id).hide();
                $('#ids_'+check_id).val('');
            }

        });


        function nanCheck(val)
        {
            var total = val;
            if(isNaN(val)) {
                var total = 0;
            }
            return total;
        }

    </script>


    <script>
                /*=========== for description update ============== */
                $(document).ready(function() {
                    var max_fields      = 10;
                    var wrapper         = $(".containerdaytime");
                    var add_button      = $(".adddaytime");

                    var x = 1;
                    $(add_button).click(function(e){
                        e.preventDefault();
                        if(x < max_fields){
                            x++;
                            $(wrapper).append(`<div class='form-group row'>
                                        <div class='col-md-4'>
                                            <label for='' class='col-md-12'>Day</label>
                                            <div class='col-md-12'>
                                                <select name='day_id[]' id='' class='form-control' required>
                                                        <option value=''>Select Day</option>
                                                        @foreach($daies as $day)
                                                        <option {{ old('day_id') == $day->id ? 'selected' : '' }} value='{{ $day->id }}'>{{ $day->name }}</option>
                                                        @endforeach

                                                </select>
                                            </div>
                                        </div>
                                            <div class='col-md-4'>
                                            <label for="" class='col-md-12'>Start Time</label>
                                            <div class="col-md-12">
                                                <input type='time' class='form-control' name='start_time[]' value='{{ old('start_time') }}' required>
                                            </div>
                                        </div>

                                        <div class='col-md-4'>
                                            <label for='' class='col-md-12'>End Time</label>
                                            <div class='col-md-12'>
                                                <input type='time' class='form-control' name='end_time[]' value='{{ old('end_time') }}' required>
                                            </div>
                                        </div>
                                        </div>`); //add input box
                        }
                else
                {
                alert('You Reached the limits')
                }
                    });

                    $(wrapper).on("click",".delete", function(e){
                        e.preventDefault(); $(this).parent('div').remove(); x--;
                    })
                });

        </script>




    @endsection
    @endsection
