@extends('frontend.layouts.app')
@section('title','Student Login')
@section('content')

 <section class="registation-section py-5">
		<div class="container">
			<div class="row">
			<div class="col-md-12">
			    <div class="registrationtitle text-center">
			        <h3>Online Registration</h3>
			    </div>
			   </div>
				<div class="col-12">
					<div class="registation">
						<form action="{{ route('student.register.store') }}" method="post" enctype="multipart/form-data">
							@csrf
							<div class="form-group">
								<label for="name"> Your Name : </label>
								<input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Your Name">
								<div class="text-danger"> {{ $errors->first('name') }} </div>	
							</div>
							<div class="form-group">
								<label for="number">Mobile No : </label>
								<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" id="number" placeholder="Mobile No ">
								<div class="text-danger"> {{ $errors->first('mobile') }} </div>	
							</div>
							<div class="form-group">
								<label for="number">Email  : </label>
								<input type="text" name="email" value="{{ old('email') }}" class="form-control" id="number" placeholder="Email ">
								<div class="text-danger"> {{ $errors->first('email') }} </div>	
							</div>
				            <div class="form-group">
								<label for="password">Password : </label>
								<input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Password">
								<div class="text-danger"> {{ $errors->first('password') }} </div>	
							</div>
							<div class="form-group">
								<label for="Confirm">Confirm Password : </label>
								<input type="password" name="com_password" value="{{ old('com_password') }}" class="form-control" id="Confirm" placeholder="Confirm Password ">
								<div class="text-danger"> {{ $errors->first('com_password') }} </div>	
							</div>
							
							<div class="form-group">
								<label for="Confirm">Address : </label>
								<input type="text" name="address" value="{{ old('address') }}" class="form-control" id="Confirm" placeholder="Address">
								<div class="text-danger"> {{ $errors->first('address') }} </div>	
							</div>
							
							<div class="form-group">
							    <input type="checkbox" name="agreed" required> I agreed terms and conditions
							    <div class="text-danger"> {{ $errors->first('agreed') }} </div>	
							</div>

							<button type="submit" class="btn btn-custom"><i class="fa fa-sign-in"></i> Registation</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection