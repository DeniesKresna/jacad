<div class="responsive-header">
    <div class="responsive-menubar">
        <div class="res-logo">
            <a href="{{ url('/') }}" title="">
                <img src="{{ url('/').'/gallery/jobhun.png' }}" width="178" alt="" />
            </a>
        </div>
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
        @if (!Auth::check())
            <!-- Btn Extras -->
            <div class="btn-extars">
                <a href="{{ url('jobs/create') }}" title="" class="post-job-btn">
                    <i class="la la-plus"></i> Post Jobs
                </a>
                
                <ul class="account-btns">
                    <li class="signup-popup">
                        <a title="">
                            <i class="la la-key"></i> Daftar
                        </a>
                    </li>
                    <li class="signin-popup">
                        <a title="">
                            <i class="la la-external-link-square"></i> Masuk
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Btn Extras -->
        @else
            <div class="my-profiles-sec">
                <span>
                    <img src="http://placehold.it/50x50" alt="" /> 
                    {{ Auth::user()->name }} <i class="la la-bars"></i>
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
                    <a href="#" title="">Layanan</a>
                    <ul>
                        <li>
                            <a href="{{ url('/academies') }}" title="">Jobhun Academy</a>
                        </li>
                        <li>
                            <a href="" title="">Jobhun Ask Career</a>
                        </li>
                        <li>
                            <a href="{{ url('/jobs') }}" title="">Jobhun Career Hub</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item-has-children">
                    <a href="#" title="">Program</a>
                    <ul>
                        <li>
                            <a href="{{ url('/blogs/category/jobhun-internship') }}" title="">Jobhun Internship</a>
                        </li>
                        <li>
                            <a href="{{ url('/blogs/category/jobhun-talks') }}" title="">Jobhun Talks</a>
                        </li>
                        <li>
                            <a href="{{ url('/blogs/category/jobhun-visit') }}" title="">Jobhun Visit</a>
                        </li>
                        <li>
                            <a href="{{ url('/student-ambassador') }}" title="">Jobhun Student Ambrassador</a>
                        </li>
                        <li>
                            <a href="" title="">Virtual Job Fair</a>
                        </li>
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
            <!-- LOGO -->
            <div class="logo">
                <a href="{{url('/')}}" title="">
                    <img src="https://jobhun.id/wp-content/uploads/2018/11/cropped-logo-jobhun-3.png" width="80" alt="" />
                </a>
            </div>
            <!-- LOGO -->

            @if (!Auth::check())
                <!-- BUTTON EXTRAS -->
                <div class="btn-extars">
                    <!--<a href="{{ url('/jobs/create') }}" title="" class="post-job-btn">
                        <i class="la la-plus"></i> Post Jobs
                    </a>-->
                    
                    <ul class="account-btns">
                        <li class="signup-popup">
                            <a title="">
                                <i class="la la-key"></i> Daftar
                            </a>
                        </li>
                        <li class="signin-popup">
                            <a title="">
                                <i class="la la-external-link-square"></i> Masuk
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- BUTTON EXTRAS -->
            @else
                <div class="my-profiles-sec">
                    <span>
                        <img src="http://placehold.it/50x50" alt="" /> 
                        {{ Auth::user()->name }} <i class="la la-bars"></i>
                    </span>
                </div>
            @endif
            
            <!-- MENU -->
            <nav>
                <ul>
                    <!--<li class="menu-item">
                        <a href="{{ url('/') }}" title="">Home</a>
                    </li>-->

                    <li class="menu-item-has-children">
                        <a href="#" title="">Layanan</a>
                        <ul>
                            <li>
                                <a href="{{ url('/academies') }}" title="">Jobhun Academy</a></li>
                            <li>
                                <a href="" title="">Jobhun Ask Career</a>
                            </li>
                            <li>
                                <a href="{{ url('/jobs') }}" title="">Jobhun Career Hub</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children">
                        <a href="#" title="">Program</a>
                        <ul>
                            <li>
                                <a href="{{ url('/blogs/category/jobhun-internship') }}" title="">Jobhun Internship</a>
                            </li>
                            <li>
                                <a href="{{ url('/blogs/category/jobhun-talks') }}" title="">Jobhun Talks</a>
                            </li>
                            <li>
                                <a href="{{ url('/blogs/category/jobhun-visit') }}" title="">Jobhun Visit</a>
                            </li>
                            <li>
                                <a href="{{ url('/student-ambassador') }}" title="">Jobhun Student Ambrassador</a>
                            </li>
                            <li>
                                <a href="" title="">Virtual Job Fair</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!--<li class="menu-item">
                        <a href="{{url('/blog')}}" title="">Blog</a>
                    </li>
                    <li class="menu-item">
                        <a href="#" title="">About</a>
                    </li>-->

                    {{-- @if (Session::has('user'))
                        <li class="menu-item">
                            <div class="btn-extars">
                                <a href="{{ url('/jobs/create') }}" title="" class="post-job-btn">
                                    <i class="la la-plus"></i> Post Jobs
                                </a>
                            </div> 
                        </li>
                    @endif --}}
                </ul>
            </nav>
            <!-- MENU -->

        </div>
    </div>
</header>

@if (Auth::check())
    <div class="profile-sidebar">
        <span class="close-profile">
            <i class="la la-close"></i>
        </span>

        <div class="can-detail-s">
            <div class="cst">
                <img src="http://placehold.it/145x145" alt="" />
            </div>
            <h3>{{ Auth::user()->name }}</h3>
            <span>
                <i>UX / UI Designer</i> at Atract Solutions
            </span>
            <p>{{ Auth::user()->email }}</p>
            <p>Bergabung sejak, 2017</p>
            {{-- <p>
                <i class="la la-map-marker"></i> {{ Session::get('user')->address }}
            </p> --}}
        </div>
        
        <div class="tree_widget-sec">
            <ul>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_profile.html') }}" title="">
                        <i class="la la-file-text"></i> Profil
                    </a>
                </li>
                <li>
                    <a href="" title="">
                        <i class="la la-graduation-cap"></i> Kelas yang diiukuti
                    </a>
                </li>
                <li>
                    <a href="" title="">
                        <i class="la la-book"></i> Mentoring yang diikuti
                    </a>
                </li>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_applied_jobs.html') }}" title="">
                        <i class="la la-paper-plane"></i> Lowongan kerja yang dilamar
                    </a>
                </li>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_change_password.html') }}" title="">
                        <i class="la la-flash"></i> Ganti kata sandi
                    </a>
                </li>
                <li>
                    <a href="{{ url('/logout') }}" title="">
                        <i class="la la-unlink"></i> Keluar
                    </a>
                </li>
                <!--<li>
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
                    <a href="{{ url('/public/theme/jobhun/candidates_job_alert.html') }}" title="">
                        <i class="la la-user"></i> Job Alerts
                    </a>
                </li>
                <li>
                    <a href="{{ url('/public/theme/jobhun/candidates_cv_cover_letter.html') }}" title="">
                        <i class="la la-file-text"></i> CV & Cover Letter
                    </a>
                </li>-->
            </ul>
        </div>
    </div>
@endif