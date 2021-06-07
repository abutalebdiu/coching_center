@extends('frontend.layouts.app')
@section('title','Student Profile')
@section('content')

	<section class="user-dashboard">
        <div class="container">
           <div class="row">


               @include('frontend.studentdashboard.dashboardmenu')

               <div class="col-12 col-md-9">
                <div class="dashboard-main w-100 bd-highlight py-3 mt-3">
                    <div class="dr-head">
                        <h6>Profile</h6>
                        <hr>
                    </div>

                    <div class="hr-body">
                   
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
                                <td>{{ $student->name }}</td>
                             </tr>
                             <tr>
                               <th>Email</th>
                               <td>{{ $student->email }}</td>
                             </tr>
                             <tr>
                                <th>Mobile</th>
                                <td>{{ $student->mobile }}</td>
                             </tr>
                             <tr>
                               <th>Address</th>
                               <td>{{ $student->address }}</td>
                             </tr>
                             <tr>
                               <th>Action</th>
                               <td><a href="{{ route('student.profile.edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
                             </tr>

                           </tbody>
                         </table>
                   
                    </div>
                 </div>

               </div>
           </div>
           
        </div>
    </section>

@endsection