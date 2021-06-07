 <div class="col-12 col-md-3">
                   <div class="dashboard-left flex-shrink-1 bd-highlight py-3 mt-3 mb-3">
                    <div class="dr-head">
                        <img src="{{ asset('public/images/students/student.png') }}" alt="" width="100%">
                        <h6>{{ Auth::user()->name }}</h6>
                        <a href="#"> <i class="fa fa-sign-out"></i>  Sign Out</a>
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
                 </div>
 			  </div>