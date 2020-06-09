@extends('user')

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

				 			<!--
				 			<div class="tags-share">
						 			<div class="tags_widget">
						 				<span>Tags</span>
						 				<a href="#" title="">Adwords</a>
						 				<a href="#" title="">Sales</a>
						 				<a href="#" title="">Travel</a>
						 			</div>
						 		<div class="share-bar">
					 				<a href="#" title="" class="share-fb"><i class="fa fa-facebook"></i></a><a href="#" title="" class="share-twitter"><i class="fa fa-twitter"></i></a><a href="#" title="" class="share-google"><i class="la la-google"></i></a><span>Share</span>
					 			</div>
				 			</div>-->
				 			<div class="post-navigation ">
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
				 			<!--
				 			<div class="comment-sec">
				 				<h3>4 Comments</h3>
				 				<ul>
				 					<li>
				 						<div class="comment">
				 							<div class="comment-avatar"> <img src="http://placehold.it/90x90" alt="" /> </div>
				 							<div class="comment-detail">
				 								<h3>Ali TUFAN</h3>
				 								<div class="date-comment"><a href="#" title=""><i class="la la-calendar-o"></i>Jan 16, 2016 07:48 am</a></div>
				 								<p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement tantaneously eel valiantly petted this along across highhandedly much. </p>
				 								<a href="#" title=""><i class="la la-reply"></i>Reply</a>
				 							</div>
				 						</div>
				 						<ul class="comment-child">
				 							<li>
				 								<div class="comment">
						 							<div class="comment-avatar"> <img src="http://placehold.it/90x90" alt="" /> </div>
						 							<div class="comment-detail">
						 								<h3>Rachel LOIS</h3>
						 								<div class="date-comment"><a href="#" title=""><i class="la la-calendar-o"></i>Jan 16, 2016 07:48 am</a></div>
						 								<p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement tantaneously eel valiantly petted this along across highhandedly much. </p>
						 								<a href="#" title=""><i class="la la-reply"></i>Reply</a>
						 							</div>
						 						</div>
				 							</li>
				 						</ul>
				 					</li>
				 					<li>
				 						<div class="comment">
				 							<div class="comment-avatar"> <img src="http://placehold.it/90x90" alt="" /> </div>
				 							<div class="comment-detail">
				 								<h3>Kate ROSELINE</h3>
				 								<div class="date-comment"><a href="#" title=""><i class="la la-calendar-o"></i>Jan 16, 2016 07:48 am</a></div>
				 								<p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement tantaneously eel valiantly petted this along across highhandedly much. </p>
				 								<a href="#" title=""><i class="la la-reply"></i>Reply</a>
				 							</div>
				 						</div>
				 					</li>
				 					<li>
				 						<div class="comment">
				 							<div class="comment-avatar"> <img src="http://placehold.it/90x90" alt="" /> </div>
				 							<div class="comment-detail">
				 								<h3>Luis DANIEL</h3>
				 								<div class="date-comment"><a href="#" title=""><i class="la la-calendar-o"></i>Jan 16, 2016 07:48 am</a></div>
				 								<p>Far much that one rank beheld bluebird after outside ignobly allegedly more when oh arrogantly vehement tantaneously eel valiantly petted this along across highhandedly much. </p>
				 								<a href="#" title=""><i class="la la-reply"></i>Reply</a>
				 							</div>
				 						</div>
				 					</li>
				 				</ul>
				 			</div>
				 			<div class="commentform-sec">
				 				<h3>Leave a Reply</h3>
				 				<form>
				 					<div class="row">
				 						<div class="col-lg-12">
					 						<span class="pf-title">Description</span>
					 						<div class="pf-field">
					 							<textarea></textarea>
					 						</div>
					 					</div>
					 					<div class="col-lg-8">
					 						<span class="pf-title">Full Name</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="ALi TUFAN" />
					 						</div>
					 					</div>
					 					<div class="col-lg-8">
					 						<span class="pf-title">Email</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="" />
					 						</div>
					 					</div>
					 					<div class="col-lg-8">
					 						<span class="pf-title">Phone</span>
					 						<div class="pf-field">
					 							<input type="text" placeholder="" />
					 						</div>
					 					</div>
					 					<div class="col-lg-12">
					 						<button type="submit">Post Comment</button>
					 					</div>
				 					</div>
				 				</form>
				 			</div>
				 			-->
				 		</div>
					</div>
					@include('partial.rightbar')
				 </div>
			</div>
		</div>
	</section>
@endsection