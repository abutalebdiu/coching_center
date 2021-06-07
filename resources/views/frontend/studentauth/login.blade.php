@extends('frontend.layouts.app')
@section('title','Student Login')
@section('content')

<section class="registation-section py-5">
		<div class="container">
			<div class="row">
                <div class="col-md-12">
                    <div class="registrationtitle text-center">
                        <h3>User Login</h3>
                    </div>
			   </div>
				<div class="col-12">
					<div class="registation">
						<form action="{{ route('student.login') }}" method="post">
							@csrf
							<div class="form-group">
								<label for="Roll">Mobile Number : </label>
								<input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" id="Roll" placeholder="Mobile Number 017xxxxxxxx">
							</div>

							<div class="form-group">
								<label for="password">Password : </label>
								<input type="password" name="password" value="{{ old('password') }}" class="form-control" id="password" placeholder="Password">
							</div>
							<button type="submit" class="btn btn-custom"><i class="fa fa-sign-in"></i> login</button>
						</form>
					</div>
				</div>
			</div>
		</div>
</section>

@endsection