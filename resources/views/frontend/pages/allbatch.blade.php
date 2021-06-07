@extends('frontend.layouts.app')
@section('title','detail')
@section('content')


 	<!--	brdc-section-->
	<section class="brdc-section py-3 bgg">
		<div class="container section-box">
			<div class="row">
				<div class="col-12">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb wow animate__animated animate__fadeInUp">
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Batches</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!--	brdc-section end -->
	<!--	notic-section-->
	<section class="notic-section py-5 bgw">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="notic-area">
						<div class="card">
							<div class="card-header">All Batch </div>
							<div class="card-body">
								<div class="notic-top">
									<div class="row">
										<div class="col-xs-12 col-lg-2 col-md-2">

											<select class="form-control form-control"  style="width: 100%">
													<option value="">Select Class</option>
												 @foreach($classes as $class)
												 	<option value="{{ $class->id }}">{{ $class->name }}</option>}
												 @endforeach
											</select>

										</div>
										<div class="col-xs-12 col-lg-2 col-md-2">

											<select class="form-control form-control" style="width: 100%">
														<option value="">Session</option>
													@foreach($sessiones as $session)
												 		<option value="{{ $session->id }}">{{ $session->name }}</option>}
													@endforeach
											</select>

										</div>
										<div class="col-12 col-lg-6 my-3 mt-lg-0">
											 <button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
										 </div>
									</div>

								</div>
								<table class="table table-bordered table-hovered">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Batch Name</th>
                                        <th>Class</th>
                                        <th>Session</th>
                                        <th>Day Of Class</th>
                                        <th>Amount <i class="fa fa-money"></i></th>
                                        <th>Batch Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($BatchSettings as $schedule)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $schedule->batch_name }}</td>
                                        <td>{{ $schedule->classes?$schedule->classes->name:"" }}</td>
                                        <td>{{ $schedule->sessiones?$schedule->sessiones->name:'' }}</td>
                                        <td>{{ $schedule->dayandtime->count() }}/Week</td>
                                        <td> </td>
                                        <td>
                                            <p class="btn btn-primary btn-sm">{{ $schedule->classtype?$schedule->classtype->name:'' }}</p>
                                        </td>
                                        <td> <a href="{{ route('batch.enroll',$schedule->id) }}" class="btn btn-success btn-sm">Enroll Now</a> </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--	notic-section end-->



@endsection