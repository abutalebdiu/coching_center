@extends('frontend.layouts.app')
@section('title','Edit Student Profile')
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
                               <td> <input type="text" name="name" value="{{ $student->email }}" class="form-control" placeholder="Student name"> </td>
                             </tr>
                             <tr>
                                <th>Mobile</th>
                                <td> <input type="text" name="name" value="{{ $student->mobile }}" class="form-control" placeholder="Student name"></td>
                             </tr>
                             <tr>
                               <th>Address</th>
                               <td> <input type="text" name="name" value=" {{ $student->address }}" class="form-control" placeholder="Student name"></td>
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
           
        </div>
    </section>

@endsection