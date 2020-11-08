<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Jobhunt</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="author" content="CreativeLayers">

        <!-- Styles -->
        @include('partial.asset.main-css')

        @yield('extracss')
    </head>
    <body>
        <!--
        <div class="page-loading">
            <img src="images/loader.gif" alt="" />
            <span>Skip Loader</span>
        </div>-->

        <div class="theme-layout" id="scrollup">
            @include('partial.menu')

            @yield('banner')

            @yield('content')

            @include('partial.footer')
        </div>
    
        @include('partial.asset.main-js')

        @yield('extrajs')

        <!-- LOGIN & REGISTER -->

        @include('partial.popup.login-register')

        <!-- LOGIN & REGISTER -->
    </body>
</html>

