<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="job-grid border">
        <div class="job-title-sec">
            <div class="c-logo"> 
                <img src="{{ $job->company->logo_url }}" alt=""/>
            </div>
            <h3>
                <a href="#" title="">{{ $job->position }}</a>
            </h3>
            <span>{{ $job->company->name }}</span>
        </div>
        <span class="job-lctn">{{ $job->location->name }}</span>
        <a href="{{ url('/jobs/'.$job->id) }}" title="">APPLY NOW</a>
    </div>
</div>