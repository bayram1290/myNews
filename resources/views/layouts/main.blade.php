<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'myNews') }}</title>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
  </head>
  <body>
    <div id="app" class="d-flex flex-column min-vh-100">
      @include('layouts.shared.front_header')
      <main class="py-4">
        @yield('content')
      </main>
      @include('layouts.shared.footer')
    </div>    
    <script src="{{asset('js/jquery-3.7.1.min.js')}}"></script>
    @yield('js')
</body>
</html>
