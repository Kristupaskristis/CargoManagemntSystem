<!DOCTYPE html>
<html>
<head>
    <title>Krovinių valdymo sistema</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}">

    <!-- plugin css -->
{!! Html::style('assets/plugins/@mdi/font/css/materialdesignicons.min.css') !!}
<!-- end plugin css -->

    <!-- plugin css -->
@stack('plugin-styles')
<!-- end plugin css -->

    <!-- common css -->
{!! Html::style('assets/css/app.css') !!}
<!-- end common css -->

    @stack('style')
</head>
<body data-base-url="{{url('/')}}">

<div class="container-scroller" id="app">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        @yield('content')
    </div>
</div>

<!-- base js -->
{!! Html::script('assets/js/app.js') !!}
<!-- end base js -->

<!-- plugin js -->
@stack('plugin-scripts')
<!-- end plugin js -->

@stack('custom-scripts')
</body>
</html>
