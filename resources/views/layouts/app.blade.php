<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{ Cookie::get('theme') ?? 'light' }}">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   @yield('headScripts')
  

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Laravel') }}</title>

   <!-- Fonts -->
   <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

   <!-- Bootstarp CSS -->
   {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous"> --}}
   

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@6.6.6/css/flag-icons.min.css" />

   <!-- Bootstarp icons -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

   @vite(['resources/sass/app.scss', 'resources/js/app.js'])

   @yield('headStyles')
   
   <!-- Scripts -->

   <link rel="stylesheet" href="{{ asset('css/app.css') }}">

   
</head>

<body>
   <input id="authenticated" type="hidden" value="{{ auth()->check() }}">
   <div id="app">
      @include('layouts.navigation')

      <main class="py-4">
         <div class="container">
            @yield('content')
         </div>
      </main>
   </div>

   <!-- jQuery  -->
   <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
      crossorigin="anonymous"></script>

   <!-- Bootstrap JS -->
   {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script> --}}

   <!-- Sweetalert2 -->
   <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

   <script type="module" src="{{ asset('js/script.js') }}"></script>

   @yield('scripts')

</body>

</html>