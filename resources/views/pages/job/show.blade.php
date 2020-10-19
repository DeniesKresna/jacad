@extends('layouts.user')

@section('banner')
	@include('partial.header.job')
@endsection

@section('content')	
	<section>
		<div class="block">
			<div class="container">
				<div class="row">
				 	<div class="col-lg-8 column">
				 		<div class="job-single-sec">
                            
                            <!-- JOB HEADER --> 
                            <div class="job-single-head">
				 				<div class="job-thumb"> 
                                     <img src="http://placehold.it/107x101" alt="" /> 
                                </div>
				 				<div class="job-head-info">
				 					<h4>{{ $job->company->name }}</h4>
				 					<span>{{ $job->company->address }}</span>
				 					<p>
                                        <i class="la la-unlink"></i> {{ $job->company->site_url }}
                                    </p>
				 					<p>
                                        <i class="la la-phone"></i> {{ $job->company->phone }}
                                    </p>
				 					<p>
                                        <i class="la la-envelope-o"></i> {{ $job->company->email }}
                                    </p>
				 				</div>
                            </div>
                            <!-- JOB HEADER --> 
                            
                            <!-- JOB DETAILS -->
				 			<div class="job-details">
                                <h3>Job Description</h3>
				 				<p>Company is a 2016 Iowa City-born start-up that develops consectetuer adipiscing elit. Phasellus hendrerit. Pellentesque aliquet nibh nec urna. In nisi neque, aliquet vel, dapibus id, mattis vel, nisi. Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Nullam mollis. Ut justo. Suspendisse potenti.</p>
				 				<p>Sed egestas, ante et vulputate volutpat, eros pede semper est, vitae luctus metus libero eu augue. Morbi purus libero, faucibus adipiscing, commodo quis, gravida id, est. Sed lectus. Praesent elementum hendrerit tortor. Sed semper lorem at felis. Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien</p>
				 				<h3>Required Knowledge, Skills, and Abilities</h3>
				 				<ul>
				 					<li>Ability to write code – HTML & CSS (SCSS flavor of SASS preferred when writing CSS)</li>
				 					<li>Proficient in Photoshop, Illustrator, bonus points for familiarity with Sketch (Sketch is our preferred concepting)</li>
				 					<li>Cross-browser and platform testing as standard practice</li>
				 					<li>Experience using Invision a plus</li>
				 					<li>Experience in video production a plus or, at a minimum, a willingness to learn</li>
				 				</ul>
				 				<h3>Education + Experience</h3>
				 				<ul>
				 					<li>Advanced degree or equivalent experience in graphic and web design</li>
				 					<li>3 or more years of professional design experience</li>
				 					<li>Direct response email experience</li>
				 					<li>Ecommerce website design experience</li>
				 					<li>Familiarity with mobile and web apps preferred</li>
				 					<li>Excellent communication skills, most notably a demonstrated ability to solicit and address creative and design feedback</li>
				 					<li>Must be able to work under pressure and meet deadlines while maintaining a positive attitude and providing exemplary customer service</li>
				 					<li>Ability to work independently and to carry out assignments to completion within parameters of instructions given, prescribed routines, and standard accepted practices</li>
				 				</ul>
                            </div>
                            <!-- JOB DETAILS -->
                            
                            <div class="share-bar">
                                <span>Share</span>
                                <a href="#" title="" class="share-fb">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#" title="" class="share-twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </div>
                            
                            <!-- RECENT JOBS -->
				 			<div class="recent-jobs">
				 				<h3>Recent Jobs</h3>
				 				<div class="job-list-modern">
								 	<div class="job-listings-sec no-border">
                                        
										<div class="job-listing wtabs">
											<div class="job-title-sec">
												<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
												<h3><a href="#" title="">Web Designer / Developer</a></h3>
												<span>Massimo Artemisis</span>
												<div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
											</div>
											<div class="job-style-bx">
												<span class="job-is ft">Full time</span>
												<span class="fav-job"><i class="la la-heart-o"></i></span>
												<i>5 months ago</i>
											</div>
                                        </div>
                                        
										<div class="job-listing wtabs">
											<div class="job-title-sec">
												<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
												<h3><a href="#" title="">C Developer (Senior) C .Net</a></h3>
												<span>Massimo Artemisis</span>
												<div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
											</div>
											<div class="job-style-bx">
												<span class="job-is pt ">Part time</span>
												<span class="fav-job"><i class="la la-heart-o"></i></span>
												<i>5 months ago</i>
											</div>
                                        </div>
                                        
										<div class="job-listing wtabs">
											<div class="job-title-sec">
												<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
												<h3><a href="#" title="">Regional Sales Manager South</a></h3>
												<span>Massimo Artemisis</span>
												<div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
											</div>
											<div class="job-style-bx">
												<span class="job-is ft ">Full time</span>
												<span class="fav-job"><i class="la la-heart-o"></i></span>
												<i>5 months ago</i>
											</div>
                                        </div>
                                        
										<div class="job-listing wtabs">
											<div class="job-title-sec">
												<div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
												<h3><a href="#" title="">Marketing Dairector</a></h3>
												<span>Massimo Artemisis</span>
												<div class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</div>
											</div>
											<div class="job-style-bx">
												<span class="job-is ft ">Full time</span>
												<span class="fav-job"><i class="la la-heart-o"></i></span>
												<i>5 months ago</i>
											</div>
                                        </div>

									</div>
								</div>
                            </div>
                            <!-- RECENT JOBS -->

				 		</div>
                    </div>
                    
				 	@include('partial.jobrightbar')
				</div>
			</div>
		</div>
	</section>
@endsection