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
                                    <form action="{{ url('/jobs') }}" method="GET">
										<div class="row">
											<div class="col-lg-7">
												<div class="job-field">
													<input type="text" name="position" placeholder="Posisi pekerjaan"/>
													<i class="la la-keyboard-o"></i>
												</div>
											</div>
											<div class="col-lg-4">
												<div class="job-field">
													<select name="location_id" data-placeholder="Lokasi" class="chosen-city">
                                                        <option value="all">- Semua lokasi -</option>
                                                        @foreach ($locations as $location)
                                                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                                                        @endforeach
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
                        <!--<span class="emlthis">
                            <a href="mailto:example.com" title="">
                                <i class="la la-envelope-o"></i> Email me Jobs Like These
                            </a>
                        </span>-->
                        
                        {{--  FILTER BAR --}}
                        <div class="filterbar">
                            <h5>{{ count($jobs) }} Jobs & Vacancies</h5>
                            <!--<div class="sortby-sec">
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
                            </div>-->
                        </div>
                        {{--  FILTER BAR --}}

                        <div class="job-grid-sec">
                            @if (count($jobs) > 0)
                                <div class="row">
                                    @foreach ($jobs as $job)
                                        @include('components.job', [
                                            'job' => $job,
                                            'css_class' => 'col-4' 
                                        ])
                                    @endforeach
                                </div>
                            @else
                                <span>Belum ada lowongan pekerjaan.</span>
                            @endif
                        </div>

                        {{-- PAGINATION --}}
                        <div class="pagination">
							<ul>
								<li class="prev">
                                    <a href="">
                                        <i class="la la-long-arrow-left"></i> Sebelumnya
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
                                        Selanjutnya <i class="la la-long-arrow-right"></i>
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