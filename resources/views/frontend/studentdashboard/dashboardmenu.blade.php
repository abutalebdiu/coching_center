<div class="dashboard-left flex-shrink-1 bd-highlight py-3">
                  <div class="dr-head">
                      <h6>{{ Auth::user()->name }}</h6>
                      <a href="{{ route('student.logout') }}">Logout</a>
                  </div>

                  <div class="dashboard-item py-3">
                    <ul>
                        <li class="desh-active">
                            <a href="{{ route('student.dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                Dashboard
                            </a>
                        </li>

                         <li class="desh-active">
                            <a href="{{ route('student.batch.enroll') }}">
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
                            <a href="{{ route('student.setting') }}">
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
                            <a href="{{ route('student.personal.information') }}">
                                <i class="fa fa-user"></i>
                                Personal Information
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('student.logout') }}" title=""><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                  </div>
              </div>