@extends('layouts.user')

@section('banner')
	@include('partial.header.jobopening')
@endsection

@section('content')	
	<section>
		<div class="block">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="heading">
							<h2>Jobhun Career Hub</h2>
							<span>Jobhun Career Hub menjadi solusi bagi perusahaan, instansi, lembaga, maupun organisasi yang sedang mencari kandidat terbaik. Temukan pekerja melalui Jobhun dengan cara yang mudah dan cepat.</span>
						</div><!-- Heading -->
						<div class="heading">
							<img src="{{url('/gallery/careerhub1.jpeg')}}"/>
						</div>
						<div class="plans-sec">
							<div class="row">
								<div class="col-lg-6">
									<div class="pricetable">
										<div class="pricetable-head">
											<h3>Basic Jobs</h3>
											<h2><i>$</i>10</h2>
											<span>15 Days</span>
										</div><!-- Price Table -->
										<ul>
											<li>1 job posting</li>
											<li>0 featured job</li>
											<li>Job displayed for 20 days</li>
											<li>Premium Support 24/7</li>
										</ul>
										<a href="#" title="">BUY NOW</a>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="pricetable active">
										<div class="pricetable-head">
											<h3>Standard Jobs</h3>
											<h2><i>$</i>45</h2>
											<span>20 Days</span>
										</div><!-- Price Table -->
										<ul>
											<li>11 job posting</li>
											<li>12 featured job</li>
											<li>Job displayed for 30 days</li>
											<li>Premium Support 24/7</li>
										</ul>
										<a href="#" title="">BUY NOW</a>
									</div>
								</div>
							</div>
						</div>
						<br />
						<div class="heading">
							<img src="{{url('/gallery/careerhub2.jpeg')}}"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection