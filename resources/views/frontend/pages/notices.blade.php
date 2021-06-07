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
							<li class="breadcrumb-item active" aria-current="page">Notic</li>
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
							<div class="card-header"> Notice Board </div>
							<div class="card-body">
								<div class="notic-top">
									<div class="row">
										<div class="col-6 col-lg-3">

											<select class="form-control form-control-md">
												<option style="display:none">class</option>
												<option>6</option>
												<option>7</option>
												<option>8</option>
												<option>jdc</option>
												<option>jsc</option>
												<option>hsc</option>
												<option>degree</option>
											</select>

										</div>
										<div class="col-6 col-lg-3">

											<select class="form-control form-control-md">
												<option style="display:none">type</option>
												<option>6</option>
												<option>7</option>
												<option>8</option>
												<option>jdc</option>
												<option>jsc</option>
												<option>hsc</option>
												<option>degree</option>
											</select>

										</div>
										<div class="col-12 col-lg-6 mt-3 mt-lg-0">
											<nav class="navbar navbar-light bg-light custom-nav">
												<form class="form-inline">
													<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
													<button class="btn btn-info my-2 my-sm-0" type="submit">Search</button>
												</form>
											</nav>
										</div>
									</div>

								</div>
								<table class="table table-bordered table-hovered">
									<thead>
										<tr>
											<th style="width:5%">Serial</th>
											<th style="width:12%">Publish Date</th>
											<th style="width:65%">Title</th>
											<th style="width:13%">Attachment</th>
											 
										</tr>
									</thead>
									<tbody>

										@foreach($notices as $notice)
										<tr>
											<td>{{ $loop->iteration }}</td>
											<td>{{ Date('M d,Y',strtotime($notice->publish_date)) }}</td>
											<td>{{ $notice->title }}</td>
											<td><a href="{{ asset($notice->noticesfile) }}" title="" download="">Download</a></td>
											 
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