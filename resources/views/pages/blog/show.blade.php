@extends('layouts.user')

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
                            <div class="bs-thumb">
                                <img class="img-fluid" src="{{ $blog->image_url }}"/>
                            </div>
                            <ul class="post-metas">
                                <li>
                                    <a href="#" title="">
                                        <img src="http://placehold.it/40x40" alt="" /> {{ $blog->author->name }}
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="">
                                        <i class="la la-calendar-o"></i> {{ $blog->created_at}}
                                    </a>
                                </li>
                                <!--<li><a class="metascomment" href="#" title=""><i class="la la-comments"></i>4 comments</a></li>-->
                                <li>
                                    <a href="#" title="">
                                        <i class="la la-file-text"></i>
                                        @php
                                            $tag_name = "";
                                            
                                            foreach($blog->tags as $tag){
                                                $tag_name = $tag_name.$tag->name.", ";
                                            }

                                            $tag_name = substr($tag_name, 0, -2);
                                        @endphp
                                        {{ $tag_name }}
                                    </a>
                                </li>
                            </ul>
                            <h2>{{ $blog->title }}</h2>
                            <div class="text-justify">{!! $blog->content !!}</div>
                            <div class="post-navigation">
                                @if ($blog->prev_post)
                                    <div class="post-hist prev">
                                        <a href="{{ $blog->prev_post->url }}" title="">
                                            <i class="la la-arrow-left"></i>
                                            <span class="post-histext">
                                                Prev Post <i>{{ $blog->prev_post->title }}</i>
                                            </span>
                                        </a>
                                    </div>
                                @endif
                                @if ($blog->next_post)
                                    <div class="post-hist next">
                                        <a href="{{ $blog->next_post->url}}" title="">
                                            <span class="post-histext">
                                                Next Post <i>{{ $blog->next_post->title }}</i>
                                            </span>
                                            <i class="la la-arrow-right"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @include('pages.blog.rightbar')
                </div>
            </div>
        </div>
    </section>

	{{-- <section>
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
	</section> --}}
@endsection