<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            [v-cloak] { display: none }
        </style>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="shortcut icon" href="favicon_16.ico"/>
        <link rel="bookmark" href="favicon_16.ico"/>
        <!-- site css -->
        <link rel="stylesheet" href="{{asset('theme/admin/dist/css/site.min.css')}}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://unpkg.com/vue-multiselect@2.1.0/dist/vue-multiselect.min.css">
        <title>Jobhun Admin</title>
    </head>
    <body>
        <div id="app" v-cloak>
            <app-component></app-component>
        </div>
        <script type="text/javascript" src="{{ asset('js/app.js')}} "></script>
    </body>
</html>
