<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Jobhun</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="CreativeLayers">
        
        <!-- Styles -->
        @include('partial.asset.main-css')
    </head>
    <body>
        <!--
        <div class="page-loading">
            <img src="images/loader.gif" alt="" />
        </div>-->

        <div class="theme-layout" id="scrollup">
            @include('partial.menu')

            @include('partial.header.home')
            
            @yield('content')
            
            <!--<section id="scroll-here">
                <div class="block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="heading">
                                    <h2>Our Features</h2>
                                    <span>we hope you have tried all this :)</span>
                                </div>
                                
                                <div class="cat-sec">
                                    <div class="row no-gape">
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="p-category">
                                                <a href="#" title="">
                                                    <i class="la la-bullhorn"></i>
                                                    <span>Updated Jobs</span>
                                                    <p>(22 open positions)</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="p-category">
                                                <a href="#" title="">
                                                    <i class="la la-graduation-cap"></i>
                                                    <span>Jobhun Academy</span>
                                                    <p>(22 open positions)</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="p-category">
                                                <a href="#" title="">
                                                    <i class="la la-line-chart "></i>
                                                    <span>Internship Development</span>
                                                    <p>(22 open positions)</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="p-category">
                                                <a href="#" title="">
                                                    <i class="la la-users"></i>
                                                    <span>Talent Pool</span>
                                                    <p>(22 open positions)</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cat-sec">
                                    <div class="row no-gape">
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="p-category">
                                                <a href="#" title="">
                                                    <i class="la la-phone"></i>
                                                    <span>Work Time Support</span>
                                                    <p>(22 open positions)</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="p-category">
                                                <a href="#" title="">
                                                    <i class="la la-female"></i>
                                                    <span>Talks with Expert</span>
                                                    <p>(22 open positions)</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="p-category">
                                                <a href="#" title="">
                                                    <i class="la la-building"></i>
                                                    <span>Visit Company</span>
                                                    <p>(22 open positions)</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-6">
                                            <div class="p-category">
                                                <a href="#" title="">
                                                    <i class="la la-newspaper-o"></i>
                                                    <span>WellWritten Blog</span>
                                                    <p>(22 open positions)</p>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="browse-all-cat">
                                    <a href="#" title="">Browse All Categories</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->

            <!-- <section>
                <div class="block double-gap-top double-gap-bottom">
                    <div data-velocity="-.1" style="background: url(http://placehold.it/1920x1000) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="simple-text-block">
                                    <h3>Make a Difference with Your Online Resume!</h3>
                                    <span>Your resume in minutes with JobHunt resume assistant is ready!</span>
                                    <a href="#" title="">Create an Account</a>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
            </section> -->

            <!--<section>
                <div class="block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="heading">
                                    <h2>Featured Jobs</h2>
                                    <span>Leading Employers already using job and talent.</span>
                                </div>
                                <div class="job-listings-sec">
                                    <div class="job-listing">
                                        <div class="job-title-sec">
                                            <div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
                                            <h3><a href="#" title="">Web Designer / Developer</a></h3>
                                            <span>Massimo Artemisis</span>
                                        </div>
                                        <span class="job-lctn"><i class="la la-map-marker"></i>Sacramento, California</span>
                                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                                        <span class="job-is ft">FULL TIME</span>
                                    </div>
                                    <div class="job-listing">
                                        <div class="job-title-sec">
                                            <div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
                                            <h3><a href="#" title="">Marketing Director</a></h3>
                                            <span>Tix Dog</span>
                                        </div>
                                        <span class="job-lctn"><i class="la la-map-marker"></i>Rennes, France</span>
                                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                                        <span class="job-is pt">PART TIME</span>
                                    </div>
                                    <div class="job-listing">
                                        <div class="job-title-sec">
                                            <div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
                                            <h3><a href="#" title="">C Developer (Senior) C .Net</a></h3>
                                            <span>StarHealth</span>
                                        </div>
                                        <span class="job-lctn"><i class="la la-map-marker"></i>London, United Kingdom</span>
                                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                                        <span class="job-is ft">FULL TIME</span>
                                    </div>
                                    <div class="job-listing">
                                        <div class="job-title-sec">
                                            <div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
                                            <h3><a href="#" title="">Application Developer For Android</a></h3>
                                            <span>Altes Bank</span>
                                        </div>
                                        <span class="job-lctn"><i class="la la-map-marker"></i>Istanbul, Turkey</span>
                                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                                        <span class="job-is fl">FREELANCE</span>
                                    </div>
                                    <div class="job-listing">
                                        <div class="job-title-sec">
                                            <div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
                                            <h3><a href="#" title="">Regional Sales Manager South east Asia</a></h3>
                                            <span>Vincent</span>
                                        </div>
                                        <span class="job-lctn"><i class="la la-map-marker"></i>Ajax, Ontario</span>
                                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                                        <span class="job-is tp">TEMPORARY</span>
                                    </div>
                                    <div class="job-listing">
                                        <div class="job-title-sec">
                                            <div class="c-logo"> <img src="http://placehold.it/98x51" alt="" /> </div>
                                            <h3><a href="#" title="">Social Media and Public Relation Executive </a></h3>
                                            <span>MediaLab</span>
                                        </div>
                                        <span class="job-lctn"><i class="la la-map-marker"></i>Ankara / Turkey</span>
                                        <span class="fav-job"><i class="la la-heart-o"></i></span>
                                        <span class="job-is ft">FULL TIME</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="browse-all-cat">
                                    <a href="#" title="">Load more listings</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->
            
            <!--<section>
                <div class="block">
                    <div data-velocity="-.1" style="background: url(http://placehold.it/1920x1000) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color light"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="heading light">
                                    <h2>Kind Words From Happy Candidates</h2>
                                    <span>What other people thought about the service provided by JobHunt</span>
                                </div>
                                <div class="reviews-sec" id="reviews-carousel">
                                    <div class="col-lg-6">
                                        <div class="reviews">
                                            <img src="http://placehold.it/101x101" alt="" />
                                            <h3>Augusta Silva <span>Web designer</span></h3>
                                            <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="reviews">
                                            <img src="http://placehold.it/101x101" alt="" />
                                            <h3>Ali Tufan <span>Web designer</span></h3>
                                            <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="reviews">
                                            <img src="http://placehold.it/101x101" alt="" />
                                            <h3>Augusta Silva <span>Web designer</span></h3>
                                            <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="reviews">
                                            <img src="http://placehold.it/101x101" alt="" />
                                            <h3>Ali Tufan <span>Web designer</span></h3>
                                            <p>Without JobHunt i’d be homeless, they found me a job and got me sorted out quickly with everything!  Can’t quite believe the service</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>	
                </div>
            </section>-->
            
            <!--<section>
                <div class="block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="heading">
                                    <h2>Companies We've Helped</h2>
                                    <span>Some of the companies we've helped recruit excellent applicants over the years.</span>
                                </div>
                                <div class="comp-sec">
                                    <div class="company-img">
                                        <a href="#" title=""><img src="http://placehold.it/180x80" alt="" /></a>
                                    </div>
                                    <div class="company-img">
                                        <a href="#" title=""><img src="http://placehold.it/180x80" alt="" /></a>
                                    </div>
                                    <div class="company-img">
                                        <a href="#" title=""><img src="http://placehold.it/180x80" alt="" /></a>
                                    </div>
                                    <div class="company-img">
                                        <a href="#" title=""><img src="http://placehold.it/180x80" alt="" /></a>
                                    </div>
                                    <div class="company-img">
                                        <a href="#" title=""><img src="http://placehold.it/180x80" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->

            <!--<section>
                <div class="block">
                    <div data-velocity="-.1" style="background: url(http://placehold.it/1920x655) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible no-parallax"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="heading">
                                    <h2>Quick Career Tips</h2>
                                    <span>Found by employers communicate directly with hiring managers and recruiters.</span>
                                </div>
                                <div class="blog-sec">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="my-blog">
                                                <div class="blog-thumb">
                                                    <a href="#" title=""><img src="http://placehold.it/360x200" alt="" /></a>
                                                    <div class="blog-metas">
                                                        <a href="#" title="">March 29, 2017</a>
                                                        <a href="#" title="">0 Comments</a>
                                                    </div>
                                                </div>
                                                <div class="blog-details">
                                                    <h3><a href="#" title="">Attract More Attention Sales And Profits</a></h3>
                                                    <p>A job is a regular activity performed in exchange becoming an employee, volunteering, </p>
                                                    <a href="#" title="">Read More <i class="la la-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-blog">
                                                <div class="blog-thumb">
                                                    <a href="#" title=""><img src="http://placehold.it/360x200" alt="" /></a>
                                                    <div class="blog-metas">
                                                        <a href="#" title="">March 29, 2017</a>
                                                        <a href="#" title="">0 Comments</a>
                                                    </div>
                                                </div>
                                                <div class="blog-details">
                                                    <h3><a href="#" title="">11 Tips to Help You Get New Clients</a></h3>
                                                    <p>A job is a regular activity performed in exchange becoming an employee, volunteering, </p>
                                                    <a href="#" title="">Read More <i class="la la-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-blog">
                                                <div class="blog-thumb">
                                                    <a href="#" title=""><img src="http://placehold.it/360x200" alt="" /></a>
                                                    <div class="blog-metas">
                                                        <a href="#" title="">March 29, 2017</a>
                                                        <a href="#" title="">0 Comments</a>
                                                    </div>
                                                </div>
                                                <div class="blog-details">
                                                    <h3><a href="#" title="">An Overworked Newspaper Editor</a></h3>
                                                    <p>A job is a regular activity performed in exchange becoming an employee, volunteering, </p>
                                                    <a href="#" title="">Read More <i class="la la-long-arrow-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->

            <!--<section>
                <div class="block no-padding">
                    <div class="container fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="simple-text">
                                    <h3>Gat a question?</h3>
                                    <span>We're here to help. Check out our FAQs, send us an email or call us at 1 (800) 555-5555</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>-->
            
            <a href="https://web.whatsapp.com/send?phone=6281332905635&text=" class="float" target="_blank">
                <i class="fa fa-whatsapp mt-3"></i>
            </a>

            @include('partial.footer')
        </div>

    @include('partial.asset.main-js')
    
    <!-- LOGIN & REGISTER -->

    @include('partial.popup.login-register')

    <!-- LOGIN & REGISTER -->

    </body>
</html>

