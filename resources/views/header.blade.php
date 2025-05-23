<!DOCTYPE html>
<html ng-app="cast" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <script src="{{asset('/js/angular.min.js')}}"></script>
    <script src="{{asset('/js/ui-bootstrap-tpls-3.0.6.min.js')}}"></script>
    <link href="{{asset('/css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script src="{{asset('/js/global.js')}}"></script>

    {{--    <script src= "../resources/js/angular.min.js"></script>--}}
    {{--    <script src="../resources/js/ui-bootstrap-tpls-3.0.6.min.js"></script>--}}
{{--    <link href="../resources/css/bootstrap.min.css" rel="stylesheet">--}}
{{--    <script src="../resources/js/jquery.min.js"></script>--}}

<!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>

</head>
<body ng-controller="controller">
{{--<div class="flex-center position-ref full-height">--}}
{{--    <div class="content">--}}


{{--    </div>--}}
{{--</div>--}}

