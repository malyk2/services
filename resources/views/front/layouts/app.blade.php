<!DOCTYPE html>
<html lang="en">
  @include('modules.pnotify')
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Smart services</title>
    <link rel=icon href={{ asset('favicon.png') }} sizes="16x16" type="image/png">
    <!-- Bootstrap -->
    <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('css/front.css') }}" rel="stylesheet">

    @stack('css')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('front.top-menu')

        {{-- @include('admin.top-menu') --}}
        @yield('content')

        {{-- @include('admin.footer') --}}
        <!-- /footer content -->
      {{-- </div>
    </div> --}}

    <!-- jQuery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ asset('vendors/nprogress/nprogress.js') }}"></script>

    <!-- Custom Theme Scripts -->
  </body>
</html>
