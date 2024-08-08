<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}"><h2>Мои новости</h2> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Переключить навигацию') }}">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto">
          @guest
            @if (Route::has('login'))
              <li class="nav-item"> <a class="nav-link" href="{{ route('login') }}">{{ __('Войти') }}</a></li>
            @endif
            @if (Route::has('register'))
              <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a></li>
            @endif
          @else
            <li>
              <a href="{{route('dashboard')}}" class="nav-item btn btn-outline-primary me-2">{{Auth::user()->login}}</a>
            </li>

            <li>
              <a class="nav-item btn btn-outline-danger" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Выйти') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
            </li>
          @endguest
        </ul>
      </div>
  </div>
</nav>