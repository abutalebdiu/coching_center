@extends('backend.layouts.app')
@section('title','Add New Sheet')
@section('content')



<div id="content" class="content">
    <div class="row">
        <div class="col-xl-6">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                <div class="panel-heading">
                    <h4 class="panel-title">Add New Sheet</h4>
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
                    <form action="{{ route('sheet.update',$sheet->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                           
                        <div class="form-group">
                            <label for="url">Sheet Name</label>
                            <input type="text" name="name" value="{{ $sheet->name }}" class="form-control" placeholder="Enter Sheet Name" />
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        </div>

                      
                        <div class="form-group">
                            <label for="class">Class :</label>
                            <select name="classes_id" id="classes_id" class="form-control" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option {{ $sheet->classes_id == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">{{ $errors->first('classes_id') }}</div>
                        </div>
                        
                       
                        <div class="form-group">
                            <label for="Session">Session :</label>
                            <select name="sessiones_id" id="sessiones_id" class="form-control" required>
                                <option value="">Select Session</option>
                                @foreach($sessiones as $session)
                                    <option {{ $sheet->sessiones_id == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                @endforeach
                            </select>
                             <div class="text-danger">{{ $errors->first('sessiones_id') }}</div>
                        </div>



                        <div class="form-group">
                            <label for="Batch Setting">Batch  :</label>
                            <select name="batch_setting_id" id="batch_setting_id" class="form-control" required>
                                 <option value="">Select Batch</option>
                                 <option value="{{ $sheet->batch_setting_id }}" selected>{{ $sheet->batchsetting->batch_name }}</option>
                            </select>
                            <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                         </div>

                         <div class="form-group">
                            <label for="id">Payment Status</label>
                            <select name="free_for" id="free_for" class="form-control">
                                <option value="">Select Payment Status</option>
                                <option {{ $sheet->free_for == 1 ? 'selected' : '' }} value="1">Free for Online Student</option>
                                <option {{ $sheet->free_for == 2 ? 'selected' : '' }} value="2">Free for Offine Student</option>
                                <option {{ $sheet->free_for == 3 ? 'selected' : '' }} value="3">Full Free</option>
                                <option {{ $sheet->free_for == 4 ? 'selected' : '' }} value="4">Paid</option>
                            </select>
                            <div class="text-danger">{{ $errors->first('free_for') }}</div>
                        </div>
                    
                      
                           
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" name="amount" value="{{ $sheet->amount }}" class="form-control" placeholder="Enter Amount" />
                            <div class="text-danger">{{ $errors->first('amount') }}</div>
                        </div>
                         
                        

                        <div class="form-group">
                            <label for="">Sheet file (PDF or DOC or IMAGE)</label>
                            <input type="file" name="sheet_file" value="{{ old('sheet_file') }}" class="form-control" placeholder="Enter sheet_file"  accept=".jpg,.jpeg,.png,.pdf,.docx,.doc" />
                            <div class="text-danger">{{ $errors->first('sheet_file') }}</div>
                        </div>

                        <div class="form-group">
                            <label for="">Publish Date</label>
                            <input type="text" name="publish_date" value="{{ $sheet->publish_date }}" class="form-control" placeholder="Enter publish date" />
                            <div class="text-danger">{{ $errors->first('publish_date') }}</div>
                        </div>


                         
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" class="form-control">
                                <option value="" > select status</option>
                                <option {{ $sheet->status == 1 ? 'selected' : 'selected'  }} value="1"> Active</option>
                                <option {{ $sheet->status == 2 ? 'selected' : ''  }} value="2"> Inactive</option>
                            </select>
                            <div class="text-danger">{{ $errors->first('status') }}</div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
                        <a class="btn btn-sm btn-default" href="{{ route('sheet.index') }}">Back</a>

                    </form>
                </div>

            </div>
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

         $('#sessiones_id').on('change', function () {
        
              var classes_id    = $('#classes_id').val();
              var sessiones_id  = $('#sessiones_id').val();
              
               
                $.ajax({
                    type: "get",
                    url: "{{ route('get.batch.setting') }}",
                    data: {classes_id:classes_id,sessiones_id:sessiones_id},
                    success: function (data) {
                         $("#batch_setting_id").html(data);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }); 
        });
    </script>
    
    
@endsection
@endsection
