@extends('user')

@section('banner')
	@include('partial.header.title')
@endsection

@section('extracss')
	<link rel="stylesheet" type="text/css" href="{{asset('jqte/jquery-te-1.4.0.css')}}" />
@endsection

@section('extrajs')
	<script src="{{asset('jqte/jquery-te-1.4.0.min.js')}}" type="text/javascript"></script>

	<script>
		$( document ).ready(function() {
		    $(".special_ta").jqte();
		});
	</script>
@endsection

@section('content')	
	<section>
		<div class="block no-padding">
			<div class="container">
				 <div class="row no-gape">
				 	<div class="col-lg-12 column">
				 		<div class="padding-left">
					 		<div class="profile-title">
					 			<h3>Formulir Jobhun Career Hub Reguler</h3>
					 		</div>
					 		<div class="profile-form-edit">
					 			
					 		</div>
					 	</div>
					</div>
				 </div>
			</div>
		</div>
	</section>
@endsection
