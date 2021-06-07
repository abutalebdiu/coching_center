@extends('frontend.layouts.app')
@section('title','batch Enroll')
@section('content')

<section class="brdc-section py-3 bgg">
        <div class="container section-box">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Batch Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
 


<section class="notic-section py-5 bgw">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7">
                    <div class="batch_detail_text p-3">
                        <h4>Description</h4>
                        <hr>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores unde, temporibus error laborum commodi facilis tempore blanditiis tenetur quos. Sapiente a cumque tempore odio assumenda, unde quo. Officiis, enim, iusto. ipsum dolor sit amet, consectetur adipisicing elit. Repellendus velit rerum quo! Cupiditate minus est at, dignissimos animi molestias? Facere, minima quisquam tenetur est sint exercitationem suscipit obcaecati atque doloribus! ipsum dolor sit amet, consectetur adipisicing elit. Esse quaerat praesentium beatae dolor eveniet, iure maxime, consequuntur quidem quae inventore distinctio ratione iste libero ipsa voluptate ea? Veritatis, quaerat, provident. ipsum dolor sit amet, consectetur adipisicing elit. Itaque inventore, provident nam aliquam, maxime nesciunt temporibus ratione doloribus qui debitis unde, quo voluptatibus dolorem repellat ipsam, ex rerum illum quasi. ipsum dolor sit amet, consectetur adipisicing elit. Dolores tenetur, eligendi voluptas quis voluptates odio minus possimus. Itaque nobis dolores impedit sint, debitis enim obcaecati reprehenderit accusamus, dolorem quaerat eveniet.</p>
                    </div>
                </div>
                <div class="col-12 col-md-5">
                    <div class="batch_box">
                        <h5><span>Batch Fees</span> <span class="float-right"> <i class="fa fa-money"></i> 1000</span></h5>
                        <hr>
                        <h5>Class : <span>{{ $batchsetting->classes?$batchsetting->classes->name:'' }} <span class="float-right">Session : {{ $batchsetting->sessiones?$batchsetting->sessiones->name:'' }}</span></span></h5>
                        <hr>
                        <div class="batch_day">
                            <p>Day of Class <span class="float-right btn btn-sm btn-primary">{{ $batchsetting->classtype?$batchsetting->classtype->name:'' }}</span></p>
                              <table class="table table-hovered table-bordered">
                                    <thead>
                                        <tr>
                                        <th>SL</th>
                                        <th>Day</th>
                                        <th>Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($batchsetting->dayandtime as $schedule)
                                    <tr>
                                        <td>01</td>
                                        <td>{{ $schedule->day?$schedule->day->name:'' }}</td>
                                        <td> {{ date('h:i A',strtotime($schedule->start_time)) }} to {{ date('h:i A',strtotime($schedule->end_time)) }}</td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                            
                            <a href="" class="btn btn-primary btn-sm">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection