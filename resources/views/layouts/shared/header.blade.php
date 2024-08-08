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
            @canany(['create-role', 'edit-role', 'delete-role'])
              <li><a class="nav-link" href="{{ route('roles.index') }}">Управление ролями</a></li>
            @endcanany
            @canany(['create-user', 'edit-user', 'delete-user'])
              <li><a class="nav-link" href="{{ route('users.index') }}">Управление пользователями</a></li>
            @endcanany
            @canany(['create-news', 'edit-news', 'delete-news'])
              <li><a class="nav-link" href="{{ route('news.index') }}">Управление новостями</a></li>
            @endcanany
            <li class="nav-item mx-2 mt-2">|</li>
            <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre> {{ Auth::user()->login }}</a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item mb-2" href="{{route('reset.password')}}">Изменить пароль</a></li>
                <li><a class="dropdown-item mb-2" href="{{route('news.create')}}">Добавить новость</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Выйти') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
  </div>
</nav>