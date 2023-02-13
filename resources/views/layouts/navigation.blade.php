<nav class="navbar navbar-expand-md navbar-light shadow-sm fw-bold fs-5">
   <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
         <img src="{{ asset('images/logo/laravel.png') }}" alt="logo" width="36" height="36">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
         aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
         <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse " id="navbarSupportedContent">
         <!-- Left Side Of Navbar -->
         <ul class="navbar-nav me-auto">
            <li class="nav-item">
               <a class="nav-link" href="{{ route('tiny_mce') }}">
                  {{ __('messages.tiny_mce') }}</a>
            </li>
         </ul>

         <!-- Right Side Of Navbar -->
         <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
               <a id="navbarDropdownMenuLink" class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                  role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <x-dynamic-component width="30" class="me-1" component="flag-language-{{ App::getLocale() }}" />
                  <!-- {{ Config::get('languages')[App::getLocale()] }} -->
                  {{ strtoupper(substr(App::getLocale(),0,2)) }}
               </a>
               <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink">
                  @foreach (Config::get('languages') as $lang => $language)
                  @if ($lang != App::getLocale())
                  <a class="dropdown-item fs-5" href="{{ route('lang.switch', $lang) }}">
                     <x-dynamic-component width="30" component="flag-language-{{ $lang}}" />
                     <!-- {{$language}} -->
                     {{ strtoupper(substr($lang,0,2)) }}
                  </a>
                  @endif
                  @endforeach
               </div>
            </li>
            <li class="nav-item">
               <div class="d-flex align-items-center h-100">
                  <button class="btn" id="toggle-theme">
                     <span class="icon-moon " style="{{ Cookie::get('theme') == 'dark' ? 'display: none;' : '' }}">
                       <i class="bi bi-moon-fill"></i>
                     </span>
                     <span class="icon-sun " style="{{ Cookie::get('theme') == 'light' ? 'display: none;' : '' }}">
                       <i class="bi bi-sun-fill"></i>
                     </span>
                   </button>
               </div>
            </li>

            <!-- Authentication Links -->
            @guest
            @if (Route::has('login'))
            <li class="nav-item">
               <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
            </li>
            @endif

            @if (Route::has('register'))
            <li class="nav-item">
               <a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
               <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
               </a>

               <div class="dropdown-menu dropdown-menu-end fs-5" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('profile.edit') }}">
                     {{ __('messages.profile') }}
                  </a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                     {{ __('messages.logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                  </form>
               </div>
            </li>
            @endguest



         </ul>
      </div>
   </div>
</nav>