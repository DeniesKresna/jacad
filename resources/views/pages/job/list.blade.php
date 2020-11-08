@extends('layouts.user')

@section('content')
    {{-- SEARCH BAR HEADER --}}
    <section class="overlape">
        <div class="block no-padding">
            {{-- PARALLAX BACKGROUND IMAGE --}}
            <div data-velocity="-.1" style="background: url(http://placehold.it/1600x800) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>

            <div class="container fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="inner-header wform">
                            <div class="job-search-sec">
                                <div class="job-search">
                                    <h4>Explore Thousand Of Jobs With Just Simple Search...</h4>

                                    <form>
										<div class="row">
											<div class="col-lg-7">
												<div class="job-field">
													<input type="text" placeholder="Job title, keywords or company name"/>
													<i class="la la-keyboard-o"></i>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="job-field">
													<select data-placeholder="City, province or region" class="chosen-city">
														<option>Istanbul</option>
														<option>New York</option>
														<option>London</option>
														<option>Russia</option>
													</select>
													<i class="la la-map-marker"></i>
												</div>
											</div>
											<div class="col-lg-1">
												<button type="submit"><i class="la la-search"></i></button>
											</div>
										</div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- SEARCH BAR HEADER --}}

    {{-- LOADER ANIMATION --}}
    <div class="page-loading">
        <img src="{{ url('/public/theme/jobhun/images/loader.gif') }}" alt="" />
        <span>Skip Loader</span>
    </div>
    
    {{-- MAIN CONTENT --}}
    <section>
        <div class="block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="emlthis">
                            <a href="mailto:example.com" title="">
                                <i class="la la-envelope-o"></i> Email me Jobs Like These
                            </a>
                        </span>
                        
                        {{--  FILTER BAR --}}
                        <div class="filterbar">
                            <h5>{{ count($jobs) }} Jobs & Vacancies</h5>
                            <div class="sortby-sec">
                                <span>Sort by</span>
                                <select data-placeholder="Most Recent" class="chosen">
                                   <option>Most Recent</option>
                                   <option>Most Recent</option>
                                   <option>Most Recent</option>
                                   <option>Most Recent</option>
                                </select>
                                <select data-placeholder="20 Per Page" class="chosen">
                                   <option>30 Per Page</option>
                                   <option>40 Per Page</option>
                                   <option>50 Per Page</option>
                                   <option>60 Per Page</option>
                                </select>
                            </div>
                        </div>
                        {{--  FILTER BAR --}}

                        {{-- LIST JOB --}}
                        <div class="job-grid-sec">
                            <div class="row">
                                {{-- JOB ITEM -> FOR DISINI --}}
                                @foreach ($jobs as $job)
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                        <div class="job-grid border">
                                            <div class="job-title-sec">
                                                <div class="c-logo"> 
                                                    <img src="http://placehold.it/235x115" alt=""/> 
                                                </div>
                                                <h3>
                                                    <a href="#" title="">{{ $job->position }}</a>
                                                </h3>
                                                <span>{{ $job->company->name }}</span>
                                                <span class="fav-job">
                                                    <i class="la la-heart-o"></i>
                                                </span>
                                            </div>
                                            <span class="job-lctn">{{ $job->location }}</span>
                                            <a href="{{ url('/jobs/').'/'.$job->id }}" title="">APPLY NOW</a>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- JOB ITEM -> FOR DISINI --}}
                                
                            </div>
                        </div>
                        {{-- LIST JOB --}}

                        {{-- PAGINATION --}}
                        <div class="pagination">
							<ul>
								<li class="prev">
                                    <a href="">
                                        <i class="la la-long-arrow-left"></i> Prev
                                    </a>
                                </li>
								<li>
                                    <a href="">1</a>
                                </li>
								<li class="active">
                                    <a href="">2</a>
                                </li>
								<li>
                                    <a href="">3</a>
                                </li>
								<li>
                                    <span class="delimeter">...</span>
                                </li>
								<li>
                                    <a href="">14</a>
                                </li>
								<li class="next">
                                    <a href="">
                                        Next <i class="la la-long-arrow-right"></i>
                                    </a>
                                </li>
							</ul>
                        </div>
                        {{-- PAGINATION --}}
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- MAIN CONTENT --}}
@endsection