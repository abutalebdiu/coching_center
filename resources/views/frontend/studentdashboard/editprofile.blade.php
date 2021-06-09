@extends('frontend.layouts.app')
@section('title', 'Edit Student Profile')
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
                        <h6> Student Profile Update </h6>
                        <hr>
                    </div>
                    <div class="hr-body">
                         <form action="{{ route('student.profile.update') }}" method="post" accept-charset="utf-8">
                          @csrf
                           <table class="table table-bordered table-hovered">
                             <thead>
                               <tr>
                                 <th>Menu</th>
                                 <th>Information</th>
                               </tr>
                             </thead>
                             <tbody>
                               <tr>
                                  <th>Name</th>
                                  <td> <input type="text" name="name" value="{{ $student->name }}" class="form-control" placeholder="Student name"> </td>
                               </tr>
                               <tr>
                                 <th>Email</th>
                                 <td> <input type="text" name="email" value="{{ $student->email }}" class="form-control" placeholder="Student Email"> </td>
                               </tr>
                               <tr>
                                  <th>Mobile</th>
                                  <td> <input type="text" name="mobile" value="{{ $student->mobile }}" class="form-control" placeholder="Student Mobile"></td>
                               </tr>
                               <tr>
                                 <th>Address</th>
                                 <td> <input type="text" name="address" value=" {{ $student->address }}" class="form-control" placeholder="Student Address"></td>
                               </tr>
                               <tr>
                                 <th>Action</th>
                                 <td> <button type="submit" class="btn btn-primary">Submit</button></td>
                               </tr>

                             </tbody>
                           </table>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
