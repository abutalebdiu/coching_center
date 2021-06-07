
@extends('frontend.layouts.app')
@section('title','Student Login')
@section('content')

	<section class="user-dashboard">
        <div class="container">
           <div class="row">


               @include('frontend.studentdashboard.dashboardmenu')

               <div class="col-12 col-md-9">
                <div class="dashboard-main w-100 bd-highlight py-3 mt-3">
                    <div class="dr-head">
                        <h6>Dashboard</h6>
                        <hr>
                    </div>
                    <div class="hr-body">
                        
                    </div>
                 </div>

               </div>
           </div>
           
        </div>
    </section>

@endsection