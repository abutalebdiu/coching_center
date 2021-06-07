@extends('frontend.layouts.app')
@section('title','Contact')
@section('content')

  

<section class="contect-section bgw py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title py-1">
                        <h2>contect us</h2>
                        <p>send a message to us</p>
                    </div>
                </div>
            </div>
            <div class="row py-5">
                <div class="col-12 col-md-6">
                    <div class="p-contect-form">
                        <form action="{{ route('contactstore') }}" method="post">
                            @csrf
                            <div class="form-group wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                                <label for="name">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Name">
                            </div>

                            <div class="form-group wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                                <label for="email">Email</label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="yout Email">
                            </div>

                            <div class="form-group wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                                <label for="phone">Mobile Number</label>
                                <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}"  id="mobile" placeholder="mobile number">
                            </div>

                            <div class="form-group wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                                <label for="name">Subject</label>
                                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" id="name" placeholder="Enter Subject">
                            </div>

                            <div class="form-group wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                                <label for="message">Message/Comments</label>
                                <textarea class="form-control mb-2" name="message" placeholder="Your message" spellcheck="false">{{ old('message') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-custom  my-3"><i class="fa fa-paper-plane-o pr-1 wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"></i>Submit
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 mt-4">
                    <div class="contect-location">
                        <p class="wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"><span><i class="fa fa-map-marker pr-2"></i>Office Address :</span> {{ $websetting->state_address }} {{ $websetting->local_address }} {{ $websetting->address }}</p>

                        <p class="wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"><span><i class="fa fa-phone pr-2"></i>Mobile - </span> {{ $websetting->phone }}</p>

                        <p class="wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"><span><i class="fa fa-envelope-o pr-2"></i>Email - </span> {{ $websetting->email }}</p>

                        <p class="wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"><span><i class="fa fa-facebook pr-2"></i>facebook group - </span><a href="#">facebook</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>







@endsection