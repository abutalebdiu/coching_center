@extends('frontend.layouts.app')
@section('title', 'Enrollment Batch List')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                

          
            @include('frontend.studentdashboard.dashboardmenu')
         

              <div class="dashboard-main w-100 bd-highlight py-3">
                  <div class="dr-head">
                      <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i> Menu
                        </div>
                        <h6>Enrollment Batch List </h6>
                        <hr>
                    </div>
                    <div class="hr-body">
                          <div class="table-responsive">
                                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                                <thead>
                                    <tr>
                                        <th width="1%">ID</th>
                                       
                                        <th class="text-nowrap">Class</th>
                                        <th class="text-nowrap">Session</th>
                                        <th class="text-nowrap">Batch</th>
                                        <th class="text-nowrap">Class Type</th>
                                        <th class="text-nowrap">Roll</th>
                                        <th class="text-nowrap">Admission Date</th>
                                        <th class="text-nowrap">Action</th> 
                                     
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                           
                                            <td>{{ $student->classes?$student->classes->name:NULL }}</td>
                                            <td>{{ $student->sessiones?$student->sessiones->name:NULL }}</td>
                                            <td>
                                                {{ $student->batchsetting?$student->batchsetting->batch_name:NULL }}
                                            </td>
                                            <td>
                                                {{ $student->studentype?$student->studentype->name:NULL }}
                                            </td>
                                            <td>{{ $student->roll }}</td>
                                            <td>{{ date('d-m-Y', strtotime($student->admission_date)) }}</td>
                                            <td>
                                              <a href="{{ route('student.batch.enroll.detail',$student->batchsetting->id) }}" title="" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> Show</a>
                                            </td>
                                            
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                          </div>  
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
