<!--MOBILE USER DASHBOARD-->
<section class="mobile-user-dashboard">
    <div class="mud-logo">
        <img src="images/logo/logo.png" alt="logo">
        <span class="mud-close">
            <i class="fa fa-times" id="mud-close-btn"></i>
        </span>
        <h6>{{ Auth::user()->name }}</h6>
        <div>

            <a href="{{ route('student.logout') }}">
                <i class="fa fa-sign-out"></i>
                Logout
            </a>
        </div>
    </div>

    <div class="dashboard-item py-3">

        <ul>
            <li class="desh-active">
                <a href="dashboard.html">
                    <i class="fa fa-building-o"></i>
                    Batch List
                </a>
            </li>
            <li>
                <a href="dashboard2.html">
                    <i class="fa fa-money"></i>
                    Payment History
                </a>
            </li>
            <li>
                <a href="dashboard3.html">
                    <i class="fa fa-newspaper-o"></i>
                     Exam History
                </a>
            </li>
            <li>
                <a href="dashboard4.html">
                    <i class="fa fa-database"></i>
                     Sheet History
                </a>
            </li>
            <li>
                <a href="dashboard5.html">
                    <i class="fa fa-cog"></i>
                    Settings
                </a>
            </li>
           
            <li>
                <a href="{{ route('student.profile') }}">
                    <i class="fa fa-user"></i>
                    profile
                </a>
            </li>

            <li>
                <a href="{{ route('student.logout') }}" title=""><i class="fa fa-sign-out"></i> Logout</a>
            </li>

        </ul>

    </div>
</section>
<!--MOBILE USER DASHBOARD-->
