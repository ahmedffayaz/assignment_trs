<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{asset ('plugins/fontawesome-free/css/all.min.css')}}">
    <link href="{{ mix('css/theme.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  @include('adminlte.header')

  @include('adminlte.sidebar')
  @if (View::hasSection('table') || View::hasSection('create'))
  @yield('table')
  @yield('create')
  @else 
  @include('adminlte.content')
  @endif
  @include('adminlte.footer')


</body>
<script src="{{ asset ('js/app.js') }}"></script>
<script src="{{ asset ('js/adminlte.js') }}"></script>
<script src="{{ asset ('plugins/some-plugin.js') }}"></script>

</html>