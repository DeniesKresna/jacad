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

