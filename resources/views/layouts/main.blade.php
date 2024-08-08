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
      <div class="container">
        <div class="row justify-content-center mt-3">
          <div class="col-md-12">
            @if ($message = Session::get('success'))
              <div class="alert alert-success text-center" role="alert"> {{ $message }}</div>
            @endif
          </div>
        </div>
      </div>
      @yield('content')
    </main>
    @include('layouts.shared.footer')
  </div>
</body>
</html>
