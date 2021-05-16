<!DOCTYPE html>
<html>
<head>
    <title>Krovinių valdymo sistema</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('img/Ticon.ico') }}">

    {!! Html::style('assets/plugins/@mdi/font/css/materialdesignicons.min.css') !!}

@stack('plugin-styles')

<!-- common css -->
{!! Html::style('assets/css/app.css') !!}
<!-- end common css -->

    @stack('style')
</head>
<body data-base-url="{{url('/')}}">

<div class="container-scroller" id="app">
    @include('layouts.header')
    <div class="container-fluid page-body-wrapper">
        @include('layouts.sidebar')
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>
</div>

{!! Html::script('assets/js/app.js') !!}

@stack('plugin-scripts')

{!! Html::script('assets/js/misc.js') !!}
{!! Html::script('assets/js/settings.js') !!}

@stack('custom-scripts')

@yield('scripts')
</body>
</html>
