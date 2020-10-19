@extends('layouts.home')

@section('content')
    <!-- JOBHUN ACADEMY -->
    <section id="scroll-here">
       <div class="block">
            <div class="container">
                <div class="heading">
                    <h2>Belajar kemampuan baru untuk karier impian di Jobhun Academy!</h2>
                </div>
                
                <div class="row">
                    @foreach ($academies as $academy)
                        @include('components.academy', ['academy' => $academy])
                    @endforeach
                </div>  
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12 d-flex">
                            <div class="ml-auto">
                                <a class="bbutton" href="" title="">
                                    Lihat Kelas Lain
                                    <i class="la la-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </section>
    <!-- JOBHUN ACADEMY -->
    
    <!-- JOBHUN ASK CAREER -->
    <section>
        <div class="block">
            <div class="container">
                <div class="heading">
                    <h2>Temukan mentor yang sesuai dengan bidang kariermu di sini!</h2>
                </div>

                <div class="row">
                    @foreach ($ask_careers as $ask_career)
                        @include('components.ask-career', $ask_career)
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12 d-flex">
                            <div class="ml-auto">
                                <a class="bbutton" href="" title="">
                                    Lihat Mentor Lain
                                    <i class="la la-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JOBHUN ASK CAREER -->

    <!-- JOBHUN CAREER HUB -->
    <section>
        <div class="block">
            <!-- PARALLAX BACKGROUND IMAGE -->
            <div data-velocity="-.1" style="background: url(http://placehold.it/1920x1000) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color light"></div>
            <!--<div data-velocity="-.1" style="background: url(http://placehold.it/1920x1000) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color"></div>-->
            <!-- PARALLAX BACKGROUND IMAGE -->

            <div class="container">
                <div class="heading light">
                    <h2>
                        Cari pekerjaan impianmu di Jobhun Career Hub!
                    </h2>
                </div>

                <div class="job-search">
                    <!-- FORM SEARCH -->
                    <form>
                        <div class="row">
                            <div class="col-lg-7 col-md-5 col-sm-12 col-xs-12">
                                <div class="job-field">
                                    <input type="text" placeholder="Masukkan nama posisi, nama perusahaan, atau kata kunci terkait." />
                                    <i class="la la-keyboard-o"></i>
                                </div>
                            </div>
                            
                            <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                                <div class="job-field">
                                    <select data-placeholder="Lokasi" class="chosen-city">
                                        <option>New York </option>
                                        <option>Istanbul</option>
                                        <option>London</option>
                                        <option>Russia</option>
                                    </select>
                                    <i class="la la-map-marker"></i>
                                </div>
                            </div>
                            
                            <div class="col-lg-1 col-md-2 col-sm-12 col-xs-12">
                                <button type="submit">
                                    <i class="la la-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- FORM SEARCH -->
                </div>

                <div class="row">
                    @foreach ($career_hubs as $career_hub)
                        @include('components.career-hub', ['career_hub' => $career_hub])
                    @endforeach
                </div>
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-12 d-flex">
                            <div class="ml-auto">
                                <a class="bbutton" href="" title="">
                                    Lihat loker <i class="la la-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- JOBHUN CAREER HUB -->

    <!-- BLOG -->
    <section>
        <div class="block">
            <div class="container">
                <div class="heading">
                    <h2>Blog</h2>
                    <span>Baca berbagai konten seputar karier yang bisa menambah pengetahuanmu dalam dunia kerja</span>  
                </div>

                <div class="row">
                    @foreach ([1, 2, 3] as $blog)
                        @include('components.blog')
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- BLOG -->

    <!-- TESTIMONI -->
    <section>
        <div class="block">
            <!-- PARALLAX BACKGROUND IMAGE -->
            <div data-velocity="-.1" style="background: url(http://placehold.it/1920x1000) repeat scroll 50% 422.28px transparent;" class="parallax scrolly-invisible layer color light"></div>
            <!-- PARALLAX BACKGROUND IMAGE -->

            <div class="container">
                <div class="heading light">
                    <h2>Apa kata mereka</h2>
                </div>
                
                <div class="row">
                    <div class="reviews-sec" id="reviews-carousel">
                        @foreach ($testimonies as $testimony)
                            @include('components.testimony', ['testimony' => $testimony])
                        @endforeach
                    </div>
                </div>
            </div>	
        </div>
    </section>
    <!-- TESTIMONI -->
    
    <!-- PERNAH DILIPUT -->
    <section> 
        <div class="block">
            <div class="container">
                <div class="heading">
                    <h2>Pernah di liput di</h2>
                </div>
                
                <div class="row">
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/1.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/tvri.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/739914552.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/tribunnews-logo-png-4.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/idn.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/07/unnamed.png" width="120" alt="">
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/sonora.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/provoke.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/sbo.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/scg.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/pas.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/prima.png" alt="">
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/yot.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/RmoqQJM4_400x400-1.jpg" alt="">
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    <!-- PERNAH DILIPUT -->

    <!-- BEKERJASAMA DENGAN -->
    <section>
        <div class="block">
            <div class="container">
                <div class="heading">
                    <h2>Bekerjasama dengan</h2>
                </div>

                <div class="row">
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/aws-1.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/09/telkomsel-logo-png-transparent.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/dilo.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/IMG_7738.jpg" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/09/Logo-MauBelajarApa-HUGE-Square.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/download.png" alt="">
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/logo-loket-blue.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/c999c60cae7ce5a0e3afe23c78cfe474.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/FDC_Logo-Surabaya-2C-for-white-bg-1.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/09/logo-LPBI.png" width="120" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/IDSF-Logo-Hitam.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/kawankoding.png" alt="">
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/lazday-1.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/06/Annotation-2020-06-10-010815.png" alt="">
                    </div>
                    <div class="col-lg-2">
                        <img src="https://jobhun.id/wp-content/uploads/2020/09/Asset-3@4x.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BEKERJASAMA DENGAN -->
@endsection