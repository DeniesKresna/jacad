@extends('user')

@section('banner')
	@include('partial.header.blog')
@endsection

@section('content')
	<section>
		<div class="block">
			<div class="container">
				 <div class="row">
				 	<div class="col-lg-9 column">
				 		<div class="bloglist-sec">
				 			@if(count($posts)>0)
					 			@foreach($posts->items() as $post)
					 			<div class="blogpost style2">
					 				<div class="blog-posthumb"> <a href="{{$post->url}}" title=""><img src="{{$post->image_url}}" width="322" alt="" /></a> </div>
					 				<div class="blog-postdetail">
					 					<ul class="post-metas"><li><a href="#" title=""><i class="la la-calendar-o"></i>{{$post->created_at}}</a></li><!--<li><a class="metascomment" href="#" title=""><i class="la la-comments"></i>4 comments</a></li>--></ul>
					 					<h3><a href="{{$post->url}}" title="">{{$post->title}}</a></h3>
					 					{!!Str::words($post->content,20)!!}
					 					<a class="button" href="{{$post->url}}" title=""><b>Read More</b> <i class="la la-long-arrow-right"></i></a>
					 				</div>
					 			</div>
					 			@endforeach
					 			{{$posts->links()}}
					 		@else
					 			<p>No Post Yet</p>
					 		@endif
				 		</div>
					</div>
					@include('partial.rightbar')
				 </div>
			</div>
		</div>
	</section>
@endsection