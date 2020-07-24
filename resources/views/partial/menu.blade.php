<div class="responsive-header">
    <div class="responsive-menubar">
        <div class="res-logo"><a href="{{url('/')}}" title=""><img src="{{url('/').'/gallery/jobhun.png'}}" width="178" alt="" /></a></div>
        <div class="menu-resaction">
            <div class="res-openmenu">
                <img src="images/icon.png" alt="" /> Menu
            </div>
            <div class="res-closemenu">
                <img src="images/icon2.png" alt="" /> Close
            </div>
        </div>
    </div>
    
    <div class="responsive-opensec">
        @if (!Session::has('user'))
            <!-- Btn Extras -->
            <div class="btn-extars">
                <a href="{{ url('jobs/create') }}" title="" class="post-job-btn">
                    <i class="la la-plus"></i> Post Jobs
                </a>
                
                <ul class="account-btns">
                    <li class="signup-popup">
                        <a title="">
                            <i class="la la-key"></i> Sign Up
                        </a>
                    </li>
                    <li class="signin-popup">
                        <a title="">
                            <i class="la la-external-link-square"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Btn Extras -->
        @else
            <div class="my-profiles-sec">
                <span>
                    <img src="http://placehold.it/50x50" alt="" /> 
                    {{ Session::get('user')->name }} <i class="la la-bars"></i>
                </span>
            </div>
        @endif
        
        <!--
        <form class="res-search">
            <input type="text" placeholder="Job title, keywords or company name" />
            <button type="submit"><i class="la la-search"></i></button>
        </form>
        -->
        
        <div class="responsivemenu">
            <ul>
                <li class="menu-item">
                    <a href="#" title="">Home</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="#" title="">Services</a>
                    <ul>
                        <li><a href="employer_list1.html" title=""> Jobhun Career Hub</a></li>
                        <li><a href="employer_list2.html" title=""> Jobhun Academy</a></li>
                        <li><a href="employer_list3.html" title=""> Jobhun Class</a></li>
                        <li><a href="employer_list4.html" title=""> Jobhun Talent Pool</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#" title="">Program</a>
                    <ul>
                        <li><a href="candidates_list.html" title=""> Jobhun Internship</a></li>
                        <li><a href="candidates_list2.html" title=""> Jobhun Talks</a></li>
                        <li><a href="candidates_list3.html" title=""> Jobhun Visit</a></li>
                        <li><a href="candidates_single.html" title=""> Jobhun Speak</a></li>
                    </ul>
                </li>
                <li class="menu-item">
                    <a href="#" title="">Blog</a>
                </li>
                <li class="menu-item">
                    <a href="#" title="">About</a>
                </li>
            </ul>
        </div>
    </div>
</div>
	
<header class="stick-top">
    <div class="menu-sec">
        <div class="container">
            
            <!-- Logo -->
            <div class="logo">
                <a href="{{url('/')}}" title="">
                    <img src="{{url('/').'/gallery/jobhun.png'}}" width="178" alt="" />
                </a>
            </div>
            <!-- Logo -->

            @if (!Session::has('user'))
                <!-- Btn Extras -->
                <div class="btn-extars">
                    <a href="{{ url('/jobs/create') }}" title="" class="post-job-btn">
                        <i class="la la-plus"></i> Post Jobs
                    </a>
                    <ul class="account-btns">
                        <li class="signup-popup">
                            <a title="">
                                <i class="la la-key"></i> Sign Up
                            </a>
                        </li>
                        <li class="signin-popup">
                            <a title="">
                                <i class="la la-external-link-square"></i> Login
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Btn Extras -->
            @else
                <div class="my-profiles-sec">
                    <span>
                        <img src="http://placehold.it/50x50" alt="" /> 
                        {{ Session::get('user')->name }} <i class="la la-bars"></i>
                    </span>
                </div>
            @endif
            
            <nav>
                <ul>
                    <li class="menu-item">
                        <a href="{{ url('/') }}" title="">Home</a>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#" title="">Services</a>
                        <ul>
                            <li><a href="employer_list1.html" title=""> Jobhun Career Hub</a></li>
                            <li><a href="employer_list2.html" title=""> Jobhun Academy</a></li>
                            <li><a href="employer_list3.html" title=""> Jobhun Class</a></li>
                            <li><a href="employer_list4.html" title=""> Jobhun Talent Pool</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#" title="">Program</a>
                        <ul>
                            <li><a href="candidates_list.html" title=""> Jobhun Internship</a></li>
                            <li><a href="candidates_list2.html" title=""> Jobhun Talks</a></li>
                            <li><a href="candidates_list3.html" title=""> Jobhun Visit</a></li>
                            <li><a href="candidates_single.html" title=""> Jobhun Speak</a></li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a href="{{url('/blog')}}" title="">Blog</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" title="">About</a>
                    </li>
                </ul>
            </nav><!-- Menus -->
        </div>
    </div>
</header>

@if (Session::has('user'))
    <div class="profile-sidebar">
        <span class="close-profile">
            <i class="la la-close"></i>
        </span>

        <div class="can-detail-s">
            <div class="cst"><img src="http://placehold.it/145x145" alt="" /></div>
            <h3>{{ Session::get('user')->name }}</h3>
            <span>
                <i>UX / UI Designer</i> at Atract Solutions
            </span>
            <p>{{ Session::get('user')->email }}</p>
            <p>Member Since, 2017</p>
            {{-- <p>
                <i class="la la-map-marker"></i> {{ Session::get('user')->address }}
            </p> --}}
        </div>
        
        <div class="tree_widget-sec">
            <ul>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_profile.html') }}" title="">
                        <i class="la la-file-text"></i> My Profile
                    </a>
                </li>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_my_resume.html') }}" title="">
                        <i class="la la-briefcase"></i> My Resume
                    </a>
                </li>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_shortlist.html') }}" title="">
                        <i class="la la-money"></i> Shorlisted Job
                    </a>
                </li>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_applied_jobs.html') }}" title="">
                        <i class="la la-paper-plane"></i> Applied Job
                    </a>
                </li>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_job_alert.html') }}" title="">
                        <i class="la la-user"></i> Job Alerts
                    </a>
                </li>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_cv_cover_letter.html') }}" title="">
                        <i class="la la-file-text"></i> CV & Cover Letter
                    </a>
                </li>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_change_password.html') }}" title="">
                        <i class="la la-flash"></i> Change Password
                    </a>
                </li>
                <li>
                    <a href="{{ url('/session-user') }}" title="">
                        <i class="la la-unlink"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endif