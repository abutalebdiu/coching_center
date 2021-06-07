
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Choching Center</title>
    <link rel="shortcut icon" href="photos/favicon.png" type="image/x-icon">
    <!--    google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@300;400;500;600;700;800&family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">
    <!--    bootstrap-->
    <!--    animate css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="css/navbar-fixed.css">-->
    <!--    slick -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/slick.css">
    <!--    font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" />

    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/style.css">
    <!--    responsive style-->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/responsive.css"> 

</head>

<body>
    <!-- preloader start -->
    <div id="pre-loader"> <img src="{{ asset('public/frontend') }}/photos/overall.svg" alt=""></div>
    <a id="button"></a>
    <!-- preloader end -->
    <!-- main-head-->
    <header>
        <!--    header-top-->
        <section class="header-top-section">
            <div class="container">
                <div class="header-top">
                    <div class="row">
                        <div class="col-12 col-md-5 align-self-center">
                            <div class="ht-left"> <span><i class="fa fa-phone"></i><span class="call">Call Now: </span> 01816781772</span>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 col-md-2">
                            <div class="ht-middle">
                                <a href="#"> <img src="{{ asset('public/frontend') }}/photos/messenger.png" alt="messenger-image"> </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 col-md-5">
                            <div class="ht-right align-self-center">
                                <a href="{{ route('student.login') }}"> <i class="fa fa-user"></i>Login </a>
                                <a href="{{ route('student.register') }}" class="ml-2"> <i class="fa fa-user"></i>Registation </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  header-top end -->
        <!--    header section-->
        <section class="header-section">
            <div class="container">
                <div class="menubar">
                     <ul>
                        <li><a href="{{ route('frontend') }}">home</a></li>
                        <li><a href="about-us.html">about us</a></li>
                        <li><a href="product.html">Downloads</a></li>
                        <li><a href="{{ route('allbatch') }}"> Admissions </a></li>
                        <li><a href="contect.html">Payments</a></li>
                        <li><a href="{{ route('blogs') }}">Blogs</a></li>
                        <li><a href="{{ route('notices') }}">Notices</a></li>
                        <li><a href="{{ route('contact') }}">contect us</a></li>
                    </ul>
                </div>
                <div class="mobile-btn"> <i class="fa fa-bars"></i> </div>
            </div>
            <!--        mobile menu-->
            <div class="mobile-menu">
                <!--           Accordion-->
                <div class="mm-menu">
                    <div class="accordion" id="accordionExample">
                        <div class="menu-box menu-box2">
                            <div class="mh-menu">
                                <div class="mobile-btn mobile-btn2">
                                    <h4 class="py-3 corsor">menu</h4> </div>
                                <div class="mobile-btn">
                                    <h2 class="py-2 corsor">
                                        <i class="fa fa-times"></i>
                                    </h2> </div>
                            </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="index.html"><i class="fa fa-home logo-left"></i>Home</a> </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="about-us.html"><i class="fa fa-users logo-left"></i>about us</a> </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="product.html"><i class="fa fa-download logo-left"></i>Downlaods</a> </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link" id="headingTwo"> <a class="mmenu-btn" type="button" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-cogs logo-left"></i> Admissions<i class="fa fa-plus logo-right"></i></a> </div>
                            <div id="collapseTwo" class="collapse menu-body" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <ul>
                                        <li> <a href="service-details.html">Online Admission</a> </li>
                                        <li> <a href="service-details.html">Offline Admission</a> </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="portfolio.html"><i class="fa fa-money menuicon logo-left"></i>Payments</a> </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="blog.html"><i class="fa fa-file-text menuicon logo-left"></i>Blog</a> </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="blog.html"><i class="fa fa-file-text menuicon logo-left"></i>Videos</a> </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="blog.html"><i class="fa fa-file-text menuicon logo-left"></i>Notices</a> </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="contect.html"><i class="fa fa-envelope logo-left"></i>Contact us</a> </div>
                        </div>
                    </div>
                </div>
                <!--   Accordion end -->
            </div>
        </section>
        <!--    header section end-->
    </header>
    <!-- main-head end-->




    @yield('content')








    <!--    footer section-->
    <section class="footer-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="footer-about  wow animate__animated animate__fadeInUp">
                        <div class="fa-head after">
                            <h4>about us</h4> </div>
                        <div class="fa-discription py-3">
                            <p>We are provided all kinds of it supports in hole country.</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="footer-link  wow animate__animated animate__fadeInUp">
                        <div class="fa-head after">
                            <h4>important link</h4> </div>
                        <div class="fl-discription"> <a href="#"><i class="fa fa-long-arrow-right mr-2"></i><span>Eduction Board Result</span>
                            </a> <a href="#"><i class="fa fa-long-arrow-right mr-2"></i><span>Dhaka Board</span>
                            </a> <a href="#"><i class="fa fa-long-arrow-right mr-2"></i><span>Bangladesh</span>
                            </a> <a href="#"><i class="fa fa-long-arrow-right mr-2"></i><span>Newspaper</span>
                            </a> <a href="#"><i class="fa fa-long-arrow-right mr-2"></i><span>Youtubes</span>
                            </a> </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="footer-link  wow animate__animated animate__fadeInUp">
                        <div class="fa-head after">
                            <h4>Menubar</h4> </div>
                        <div class="fl-discription"> <a href="#"><i class="fa fa-long-arrow-right mr-2"></i><span>Home</span>
                            </a> <a href="#"><i class="fa fa-long-arrow-right mr-2"></i><span>About</span>
                            </a> <a href="#"><i class="fa fa-long-arrow-right mr-2"></i><span>Contect</span>
                            </a> <a href="#"><i class="fa fa-long-arrow-right mr-2"></i><span>Login</span>
                            </a> <a href="#"><i class="fa fa-long-arrow-right mr-2"></i><span>Registation</span>
                            </a> </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="fc-head  wow animate__animated animate__fadeInUp">
                        <div class="fa-head after">
                            <h4>contect us</h4> </div>
                        <div class="fc-discription">
                            <div class="fc-social-media"> <a href="#" target="_blank"><i class="fa fa-facebook"></i></a> <a href="#" target="-blank"><i class="fa fa-twitter"></i></a> <a href="#" target="-blank"><i class="fa fa-linkedin"></i></a> <a href="#" target="-blank"><i class="fa fa-instagram"></i></a> </div>
                            <div class="media pt-3">
                                <div class="media-left"> <i class="fa fa-phone"></i> </div>
                                <div class="media-body">
                                    <p> <span>Phone :</span> +8801990-575888 </p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left"> <i class="fa fa-envelope-o"></i> </div>
                                <div class="media-body">
                                    <p> <span>Email :</span> <a href="#">info@gmail.com</a> </p>
                                </div>
                            </div>
                            <form action="">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="mobile no">
                                    <div class="input-group-append"> <a href="#" type="submit" class="btn btn-custom">Subscribe</a> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--    footer section end-->
    <!--    copyright section-->
    <section class="copyright-section py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 wow animate__animated animate__fadeInUp">
                    <p>2021 © All Rights Reserved. Powered by <a href="#">Domain Name</a></p>
                </div>
            </div>
        </div>
    </section>
    <!--    copyright section end-->
    <script src="{{ asset('public/frontend') }}/js/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/popper.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/wow.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/parallax.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <script>
            @if(Session::has('message'))

            var type = "{{Session::get('alert-type','info')}}"

            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
            @endif

          

        </script>



</body>

</html>