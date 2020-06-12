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
				 		<div class="blog-single">
				 			<div class="bs-thumb"><img src="{{$post->image_url}}" width="840" height="340" alt="" /></div>
				 			<ul class="post-metas"><li><a href="#" title=""><img src="http://placehold.it/40x40" alt="" />{{$post->author->name}}</a></li><li><a href="#" title=""><i class="la la-calendar-o"></i>{{$post->created_at}}</a></li><!--<li><a class="metascomment" href="#" title=""><i class="la la-comments"></i>4 comments</a></li>--><li><a href="#" title=""><i class="la la-file-text"></i>
				 			@php
				 				$cat = "";
				 				foreach($post->categories as $category){
				 					$cat = $cat.$category->name.", ";
				 				}
				 				$cat = substr($cat, 0, -2)
				 			@endphp
				 			{{$cat}}</a></li></ul>
				 			<h2>{{$post->title}}</h2>
				 			{!! $post->content !!}

				 			<div class="post-navigation">
				 				@if($post->prev_post)
				 				<div class="post-hist prev">
				 					<a href="{{$post->prev_post->url}}" title=""><i class="la la-arrow-left"></i><span class="post-histext">Prev Post<i>{{$post->prev_post->title}}</i></span></a>
				 				</div>
				 				@endif
				 				@if($post->next_post)
				 				<div class="post-hist next">
				 					<a href="{{$post->next_post->url}}" title=""><span class="post-histext">Next Post<i>{{$post->next_post->title}}</i></span><i class="la la-arrow-right"></i></a>
				 				</div>
				 				@endif
				 			</div>
				 		</div>
					</div>
					@include('partial.rightbar')
				 </div>
			</div>
		</div>
	</section>
@endsection