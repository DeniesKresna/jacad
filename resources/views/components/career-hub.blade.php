<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
    <div class="job-grid border">
        <div class="job-title-sec">
            <div class="c-logo"> 
                <img src="http://placehold.it/235x115" alt=""/> 
            </div>
            <h3>
                <a href="#" title="">{{ $career_hub->position }}</a>
            </h3>
            <span>{{ $career_hub->company->name }}</span>
            <span class="fav-job">
                <i class="la la-heart-o"></i>
            </span>
        </div>
        <span class="job-lctn">{{ $career_hub->location->name }}</span>
        <a href="{{ url('/jobs/'.$career_hub->id) }}" title="">APPLY NOW</a>
    </div>
</div>