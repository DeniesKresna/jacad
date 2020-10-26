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
                        <div class="blog-list-sec">
                            @if (count($blogs->items()) > 0)
                                @foreach ($blogs->items() as $blog)
                                    <div class="blogpost style2">
                                        <div class="blog-posthumb"> 
                                            <a href="{{ $blog->url }}" title="">
                                                <img src="{{ $blog->image_url }}" width="322" alt="" />
                                            </a> 
                                        </div>
                                        <div class="blog-postdetail">
                                            <ul class="post-metas">
                                                <li>
                                                    <a href="#" title="">
                                                        <i class="la la-calendar-o"></i> {{ $blog->created_at }}
                                                    </a>
                                                </li>
                                                <!--<li><a class="metascomment" href="#" title=""><i class="la la-comments"></i>4 comments</a></li>-->
                                            </ul>
                                            <h3>
                                                <a href="{{ $blog->url }}" title="">{{ $blog->title }}</a>
                                            </h3>
                                            {!! Str::words($blog->content, 20) !!}
                                            <a class="button" href="{{ $blog->url }}" title="">
                                                <b>Read More</b> <i class="la la-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No Post Yet</p>
                            @endif
                        </div>
                    </div>
                    @include('pages.blog.rightbar')
                </div>
            </div>
        </div>
    </section>
@endsection