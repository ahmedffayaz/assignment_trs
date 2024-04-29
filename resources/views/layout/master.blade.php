<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset ('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link href="{{ mix('css/theme.css') }}" rel="stylesheet">
    <!-- Styles -->



</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('layout.header')

  @include('layout.sidebar')

  @yield('content')

  @include('layout.footer')


</body>
<!-- Include compiled app.js file -->
<script src="{{ asset ('js/app.js') }}"></script>
<!-- Include compiled AdminLTE JavaScript file -->
<script src="{{ asset ('js/adminlte.js') }}"></script>
<!-- Include any additional AdminLTE plugins you need -->
<script src="{{ asset ('plugins/some-plugin.js') }}"></script>

</html>