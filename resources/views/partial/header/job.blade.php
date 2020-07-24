<section class="overlape">
    <div class="block no-padding">
        <div data-velocity="-.1" style="background: url({{url('/gallery/maliq.jpg')}}) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div><!-- PARALLAX BACKGROUND IMAGE -->
        <div class="container fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-header">
                        <h3>{{ $job->position }}</h3>
                        <div class="job-statistic">
                            <span>{{ $job->type }}</span>
                            <p>
                                <i class="la la-map-marker"></i> {{ $job->location }}
                            </p>
                            <p>
                                <i class="la la-calendar-o"></i> Posted {{ $job->posted_at }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

